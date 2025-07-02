const login = document.getElementById('login');
const senha = document.getElementById('senha');
const msg_erro = document.getElementById('msg-erro');
const btnEntrar = document.getElementById('entrar');


btnEntrar.onclick = () =>{
    const endpoint ='http://localhost:8080/login';
    
    const parametros ={
        login : login.value,
        senha : senha.value,
    }

    fetch(endpoint, {
        method:"POST",
        body: JSON.stringify(parametros)
    })
    .then(response => response.json())
    .then(response => {
        if(response.status == false){
            msg_erro.style.display ='block';
            return;
        }
        window.location.assign('/home');
    }).catch(error => console.error(error));

}
