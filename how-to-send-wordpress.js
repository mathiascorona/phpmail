<script>
    function myFunc() {
        var params = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            address: document.getElementById('address').value,
            city: document.getElementById('city').value,
            state: document.getElementById('state').value,
            message: document.getElementById('message').value
        };
        
        const request = new Request('https://www.elevshopbras.com.br/error/mail/email.php', {method: 'POST', body: JSON.stringify(params)});
        
        fetch(request).then(
            (response) => {
                console.log(response);
                if (response.status == 200) {
                    document.getElementById('btn')
                    .innerHTML = '<span>SUCESSO</span>';
                }
            }
        );
    }
</script>
<form name="formContato">
    <input type="text" placeholder="Nome" name="name" id="name" />
    <input type="email" placeholder="E-mail" name="email" id="email" />
    <input type="tel" placeholder="Telefone" name="phone" id="phone" />
    <input type="text" placeholder="Endereço" name="address" id="address" />
    <input type="text" placeholder="Cidade" name="city" id="city" />
    <input type="text" placeholder="Estado" name="state" id="state" />
    <textarea placeholder="Mensagem" name="message" id="message"></textarea>
    <button id="btn" onclick="myFunc()" type="button">Enviar</button>
</form>
