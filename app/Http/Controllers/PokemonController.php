<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response as ResponseHttp;
use Illuminate\Pagination\LengthAwarePaginator;

class PokemonController extends Controller {

    const POKEMONS_TO_SHOW_PER_PAGE = 8;
    const POKE_API_CURL = 'https://pokeapi.co/api/v2';

    protected int $limit = 3000;
    protected int $offset = 0;
    protected int $hoursCachePokemonList = 2;
    protected int $minutesCachePokemon = 30;
    protected int $minutesCachePokemonSpecies = 30;
    protected int $minutesCachePokemonEvolution = 30;

    protected string $msg_bad_request = '¡Por favor, ingrese un nombre!';
    protected string $msg_not_found = '¡Pokémon no encontrado!';
    protected string $msg_internal_server_error = 'Error interno';
    protected string $msg_exception = 'Error en la solicitud';

    public function __construct() {

        $this->getPokemonList();
    }

    /**
     * Realiza una búsqueda de Pokémon basada en una coincidencia con el nombre proporcionado en la solicitud.
     *
     * @param Request $request La solicitud HTTP que contiene el nombre del Pokémon a buscar.
     * @return View Una vista con la respuesta HTTP o con los resultados de la búsqueda.
     */
    public function search(Request $request): View {

        try {
            if ($this->validateRequest($request)) {

                $pokemonName = strtolower($request['name']);
                $allPokemons = $this->getPokemonList();
                $matchedPokemons = [];

                if ($allPokemons) {
                    foreach ($allPokemons as $key => $pokemon) {
                        if (preg_match('/' . $pokemonName . '/', $pokemon['name']))
                            $matchedPokemons[$key] = $this->getPokemon($pokemon['name']);
                    }
                }

                if (empty($matchedPokemons))
                    return $this->returnViewMessageHttp($this->msg_not_found, ResponseHttp::HTTP_NOT_FOUND);

                $pokemonsPaginated = $this->renderPagination($matchedPokemons, $request);

                return view('index', ['pokemonsPaginated' => $pokemonsPaginated]);
            } else
                throw new Exception($this->msg_exception);
        } catch (Exception $e) {
            return $this->returnViewMessageHttp($this->msg_bad_request, ResponseHttp::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Realiza una búsqueda por nombre de Pokémon para ver el detalle completo.
     *
     * @param Request $request La solicitud HTTP que contiene el identificador.
     * @return View Vista que muestra los resultados de la búsqueda.
     */
    public function searchPokemon(Request $request): View {

        try {
            if ($this->validateRequest($request)) {

                $pokemon = $this->getPokemon($request['name']);
                if ($pokemon['is_default']) {
                    $pokemon['species'] = $this->getPokemonSpecies($request['name']);
                    $pokemon['evolution'] = $this->getPokemonChainByUrl($pokemon['species']['evolution_chain']['url']);
                }

                return view('pokemon-info', ['pokemon' => $pokemon]);
            } else
                throw new Exception($this->msg_exception);
        } catch (Exception $e) {
            return $this->returnViewMessageHttp($this->msg_bad_request, ResponseHttp::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Obtiene información de un Pokémon específico.
     *
     * @param string $request El nombre del Pokémon que se desea obtener.
     * @return View|array Una vista con respuesta HTTP o un array con la información del Pokémon.
     */
    public function getPokemon(string $request): View|array {

        if (Cache::has('pokemon_'.$request))
            return Cache::get('pokemon_' . $request);

        try {
            $response = Http::get(self::POKE_API_CURL.'/pokemon/'.$request);

            if ($response->successful()) {

                $pokemonResponse = $response->json();
                $pokemonResponse['weight'] = $pokemonResponse['weight'] / 10; # Conversión de hectogramos a kilogramos
                $pokemonResponse['height'] = $pokemonResponse['height'] / 10; # Conversión de decímetros a metros
                $pokemonResponse['sprite'] = $pokemonResponse['sprites']['other']['official-artwork']['front_default'] ?? NULL;
                $pokemonResponse['frontendId'] = Str::padLeft($pokemonResponse['id'], 3, '0');
                $pokemonResponse['class']['ColorType'] = $pokemonResponse['types'][0]['type']['name'].'-type';
                $pokemonResponse['class']['ColorTypeOpacity'] = $pokemonResponse['types'][0]['type']['name'].'-type-opacity';
                $pokemonResponse['class']['ColorTypeText'] = $pokemonResponse['types'][0]['type']['name'].'-type-text';

                Cache::put('pokemon_'.$request, $pokemonResponse, now()->addMinutes($this->minutesCachePokemon));
                return $pokemonResponse;
            } else
                throw new Exception($this->msg_exception);
        } catch (Exception $e) {
            return $this->returnViewMessageHttp($this->msg_internal_server_error, ResponseHttp::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Obtiene el listado de Pokémons.
     *
     * @return View|array Una vista con respuesta HTTP o un array con la información de los Pokémons existentes.
     */
    public function getPokemonList(): View|array {

        if (Cache::has('pokemon_list'))
            return Cache::get('pokemon_list');

        try {
            $response = Http::get(self::POKE_API_CURL.'/pokemon?offset='.$this->offset.'&limit='.$this->limit);

            if ($response->successful()) {

                if ($response->json()['count'] > $this->limit) {
                    $this->limit = $response->json()['count'];
                    try {
                        $response = Http::get(self::POKE_API_CURL . '/pokemon?offset=' . $this->offset . '&limit=' . $this->limit);
                    } catch (Exception $e) {
                        return $this->returnViewMessageHttp($this->msg_internal_server_error, ResponseHttp::HTTP_INTERNAL_SERVER_ERROR);
                    }
                }

                Cache::put('pokemon_list', $response->json()['results'], now()->addHours($this->hoursCachePokemonList));
                return $response->json()['results'];
            } else
                throw new Exception($this->msg_exception);
        } catch (Exception $e) {
            return $this->returnViewMessageHttp($this->msg_internal_server_error, ResponseHttp::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Obtiene información de la especie de Pokémon.
     *
     * @param string $request Nombre del Pokémon.
     * @return View|array Una vista con respuesta HTTP o un array con la información de la especie.
     */
    public function getPokemonSpecies(string $request): View|array {

        if (Cache::has('pokemon_species_'.$request))
            return Cache::get('pokemon_species_' . $request);

        try {
            $response = Http::get(self::POKE_API_CURL.'/pokemon-species/'.$request);

            if ($response->successful()) {
                Cache::put('pokemon_species_'.$request, $response->json(), now()->addMinutes($this->minutesCachePokemonSpecies));
                return $response->json();
            } else
                throw new Exception($this->msg_exception);
        } catch (Exception $e) {
            return $this->returnViewMessageHttp($this->msg_internal_server_error, ResponseHttp::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Obtiene la cadena de evolución de la especie de Pokémon.
     *
     * @param string $url # https://pokeapi.co/api/v2/evolution-chain/{id}
     * @return View|array Una vista con respuesta HTTP o un array con el detalle de la evolución.
     */
    public function getPokemonChainByUrl(string $url): View|array {

        if (Cache::has('pokemon_evolution_'.$url))
            return Cache::get('pokemon_evolution_' . $url);

        try {
            $response = Http::get($url);

            if ($response->successful()) {

                $evolution = $response->json();
                $evolutionChain = [];
                $this->transformEvolutionChain($evolution['chain'], $evolutionChain);

                Cache::put('pokemon_evolution_'.$url, $evolutionChain, now()->addHours($this->minutesCachePokemonEvolution));
                return $evolutionChain;
            } else
                throw new Exception($this->msg_exception);
        } catch (Exception $e) {
            return $this->returnViewMessageHttp($this->msg_internal_server_error, ResponseHttp::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Método recursivo para transformar la estructura del la cadena de evolución.
     *
     * @param array $evolution
     * @param array $newChain Devuelve por referencia el array procesado
     * @return void
     */
    private function transformEvolutionChain(array $evolution, array &$newChain): void {

        if (!empty($evolution['species'])) {

            $require_to_evolve = 'LVL 1';
            if (!empty($evolution['evolution_details'])) {
                foreach ($evolution['evolution_details'] as $detail) {
                    $require_to_evolve = !empty($detail['min_level']) ? 'LVL '.$detail['min_level'] : 'OTHER';
                }
            }

            $newChain[] = [
                'name' => $evolution['species']['name'],
                'require_to_evolve' => $require_to_evolve,
            ];

            if (!empty($evolution['evolves_to'])) {

                foreach ($evolution['evolves_to'] as $evolves_to) {
                    $chain_to_process = $evolves_to;
                    $this->transformEvolutionChain($chain_to_process, $newChain);
                }
            }
        }
    }

    /**
     * Calcula los valores necesarios para paginar los resultados en una vista.
     *
     * @param array $results Array de resultados de búsquedas
     * @param Request $request La solicitud HTTP.
     * @return LengthAwarePaginator Un array con los valores de paginación.
     */
    private function renderPagination(array $results, Request $request): LengthAwarePaginator {

        $collectResults = collect($results);
        $perPage = self::POKEMONS_TO_SHOW_PER_PAGE;
        $currentPage = $request->input('page', 1);

        return new LengthAwarePaginator(
            $collectResults->forPage($currentPage, $perPage), # Resultados para la página actual
            count($collectResults), # Total de resultados
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()] # Parámetros de la consulta para mantener
        );
    }

    /**
     * Valida si la solicitud contiene los datos necesarios.
     *
     * @param Request $request La solicitud HTTP que se va a validar.
     * @return bool Devuelve true si la solicitud es válida, de lo contrario, false.
     */
    private function validateRequest(Request $request): bool {

        if (!isset($request['name']) || empty($request['name']))
            return false;

        return true;
    }

    /**
     * Devuelve mensaje para respuesta HTTP 500.
     *
     * @param string $message Mensaje personalizado
     * @param int $status Código http
     * @return View
     */
    private function returnViewMessageHttp(string $message, int $status): View {

        return view('index', ['message' => $message], ['status' => $status]);
    }
}
