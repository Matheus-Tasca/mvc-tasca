var cpf = document.getElementById('cpf')

var botaoForm = document.getElementById('botaoEnviarForm')

var telefone_celular = document.getElementById('tel_celular');

var telefone_fixo = document.getElementById('numero_fixo');

var celularNumeroEdit = document.getElementById('celularNumeroEdit');

var telefoneNumeroEdit = document.getElementById('telefoneNumeroEdit');

var CEP = document.getElementById('cep');

var btnSalvaEdit = document.getElementById('btnSalvaEdit');

//expressão regular para validar se tem apenas numeros de 0-9
const validaNumeros = /^[0-9]+$/;

//função que valida se os telefones são válidos
function validaTelefone(telefone_celular, telefone_fixo){

    var telefoneCelularFormatado = telefone_celular.replaceAll(" ", "");
    var telefoneFixoFormatado = telefone_fixo.replaceAll(" ", "");

    //validação do telefone celular (obrigatório para o cadastro)
    if(!validaNumeros.test(telefoneCelularFormatado)){
        alert('O número de telefone celular é inválido!');
        event.preventDefault();
    }

    //validação do telefone fixo (opcional para o cadastro)
    if(telefoneFixoFormatado.length != 0 && !validaNumeros.test(telefoneFixoFormatado)){
        alert('O número de telefone fixo é inválido!');
        event.preventDefault();
    }
    
}

//função que valida se o CEP é valido
function validaCEP(cep){

    var cepFormatado = cep.replaceAll(" ", "");

    if(!validaNumeros.test(cepFormatado)){
        alert('O CEP deve ter apenas números!');
        event.preventDefault();
    }

}

//funcao que valida se o cpf é real
function validaCPF(cpf){
    var cpfFormatado = cpf.value.replaceAll(" ", "");
    var somaTotalPrimeiroDigito = 0;
    var somaTotalSegundoDigito = 0;
    var multiplicadorPrimeiroDigito = 1;
    var multiplicadorSegundoDigito = 0;
    var primeiroDigito;
    var segundoDigito;

    //Valida se tem apenas numeros no cpf
    if(!validaNumeros.test(cpfFormatado)){
        event.preventDefault();
        alert('O cpf deve conter apenas numeros!');

    }else{
        let cpfSeparado = cpfFormatado.split("");
        let cpfTest = cpfFormatado;
        let restoDivisao;
        
        //remove os dois ultimos digitos do cpf
        cpfSeparado.length = cpfSeparado.length -2;

        //forEach para encontrar a soma dos 9 primeiros digitos com o multiplicador
        cpfSeparado.forEach(numero => {
            somaTotalPrimeiroDigito += parseInt(numero) * multiplicadorPrimeiroDigito;
            multiplicadorPrimeiroDigito++
        });

        //encontra o primeiro digito do CPF
        restoDivisao = somaTotalPrimeiroDigito%11;
        if(restoDivisao == 10){
            restoDivisao = 0;
            primeiroDigito = restoDivisao;
        }else{
            primeiroDigito = restoDivisao;
        }

        //adiciona o primeiro digito ao cpf
        cpfSeparado.push(primeiroDigito)
        
        //forEach para a soma dos 10 digitos com o multiplicador
        cpfSeparado.forEach(numero => {
            somaTotalSegundoDigito += parseInt(numero) * multiplicadorSegundoDigito;
            multiplicadorSegundoDigito++
        });

        //encontra o segundo digito do CPF
        restoDivisao = somaTotalSegundoDigito%11;
        if(restoDivisao == 10){
            restoDivisao = 0;
            segundoDigito = restoDivisao;
        }else{
            segundoDigito = restoDivisao;
        }
        //adiciona o segundo digito ao cpf
        cpfSeparado.push(segundoDigito)

        //transforma o cpf em string novamente
        let cpfGerado = cpfSeparado.join('');

        //compara o cpf gerado com o cpf informado
        if( cpfGerado != cpfTest){
            event.preventDefault();
            alert('O CPF informado é inválido!')
        }
        
    }
}

botaoForm.addEventListener('click',(event)=>{
    validaCPF(cpf);
    validaTelefone(telefone_celular.value, telefone_fixo.value);
    validaCEP(CEP.value);
})
