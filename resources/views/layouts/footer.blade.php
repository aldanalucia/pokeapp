<footer class="bg-dark p-2 fixed-bottom text-light">
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <p class="footer-title-app">Creado por Aldana Cuello</p>
            </div>
            <div class="col-xs-12 col-md-6 d-md-flex justify-content-around">
                <p class="footer-title-app">
                    <a class="a-none a-footer" href="https://github.com/aldanalucia" target="_blank">
                        <img class="mb-1" width="20px" height="auto" src="{{ asset('images/github.png') }}" alt="GitHub">
                        &nbsp;Mi repo</a>
                </p>
            </div>
        </div>
    </main>
    <div id="ui-block" class="ui-block" >
        <div class="spinner-grow" role="status">
            <span class="visually-hidden"></span>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="{{ asset('js/poke-app.js') }}"></script>
</body>
</html>
