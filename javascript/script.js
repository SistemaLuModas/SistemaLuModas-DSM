document.addEventListener('DOMContentLoaded', function () {

   
    var anoAtual = document.getElementById('anoAtual');
    if (anoAtual) {
        anoAtual.textContent = new Date().getFullYear();
    }

    
    var navbar = document.querySelector('.navbar');
    var btnTopo = document.getElementById('btnTopo');

    function aoRolar() {
        var rolado = window.scrollY > 40;

        if (navbar) {
            navbar.classList.toggle('scrolled', rolado);
        }

        if (btnTopo) {
            btnTopo.classList.toggle('show', window.scrollY > 500);
        }
    }

    window.addEventListener('scroll', aoRolar);
    aoRolar();

    if (btnTopo) {
        btnTopo.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    
    var menu = document.getElementById('menuPrincipal');
    var linksMenu = menu ? menu.querySelectorAll('.nav-link') : [];

    linksMenu.forEach(function (link) {
        link.addEventListener('click', function () {
            if (menu.classList.contains('show')) {
                var colapsavel = bootstrap.Collapse.getOrCreateInstance(menu);
                colapsavel.hide();
            }
        });
    });

 
    var secoes = document.querySelectorAll('main section[id]');

    var observador = new IntersectionObserver(function (entradas) {
        entradas.forEach(function (entrada) {
            if (entrada.isIntersecting) {
                var idAtual = entrada.target.getAttribute('id');

                linksMenu.forEach(function (link) {
                    var apontaParaSecao = link.getAttribute('href') === '#' + idAtual;
                    link.classList.toggle('active', apontaParaSecao);

                    if (apontaParaSecao) {
                        link.setAttribute('aria-current', 'page');
                    } else {
                        link.removeAttribute('aria-current');
                    }
                });
            }
        });
    }, { rootMargin: '-45% 0px -50% 0px', threshold: 0 });

    secoes.forEach(function (secao) {
        observador.observe(secao);
    });

    
    var formulario = document.getElementById('formContato');
    var mensagemSucesso = document.getElementById('mensagemSucesso');

    if (formulario) {
        formulario.addEventListener('submit', function (evento) {
            evento.preventDefault();
            evento.stopPropagation();

            if (!formulario.checkValidity()) {
                formulario.classList.add('was-validated');
                return;
            }

            
            formulario.classList.remove('was-validated');
            formulario.reset();

            if (mensagemSucesso) {
                mensagemSucesso.classList.add('show');

                window.setTimeout(function () {
                    mensagemSucesso.classList.remove('show');
                }, 5000);
            }
        });
    }

});
