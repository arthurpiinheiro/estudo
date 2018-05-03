const user = new User();
const post = new Post();
const pathname = $(location).attr('pathname');
const formLogin = $('#formLogin');
const formInserirPost = $('#inserirPost');
const formAtualizarPost = $('#atualizarPost');
const url = [
    '/estudo/editar.html',
    '/estudo/inserir.html',
    '/estudo/editar.html',
    '/estudo/login.html',
    '/estudo/index.html',
    '/estudo/',
];


formLogin.submit(function (els) {
    user.login(els);
});

formInserirPost.submit(function (els) {
    post.insert(els);
});

formAtualizarPost.submit(function (els) {
    post.atualizar(els);
});


routes();

function routes() {
    for (let i = 0; i < url.length; i++) {
        if (pathname === url[i]) {
            user.session();
        }
    }
    if (pathname === '/estudo/index.html' || pathname === '/estudo/') {
        post.list();
    }
}


// if (pathname === url[3] || pathname === url[4]) {
//     let endereco = window.location.href.split('?');
//     // post.editar(endereco[1]);
// }

$('.sair').click(function () {
    // usuario.logout();
});

function apagar(valor) {
    if (confirm('Tem certeza que deseja apagar esta publicação?')) {
        post.apagar(valor);
    }
}
