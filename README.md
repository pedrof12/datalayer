# pedrof12/datalayer
Um simples datalayer para o seu banco de dados.

Primeiro, vamos começar fazendo a configuração dos dados de conexão!
```php
<?php 

use PedroF12\Datalayer\Connect;

// Chamando a class.
$connect = new Connect();

// Criando a conexão.
$connect->setConnection("127.0.0.1", 3306, "root", "password")->setDatabase("test");

// Se houver erro, mostre-o na tela.

/* 
* Se você quiser pegar a instancia da conexão para poder executar sql sem passar pelo datalayer é só:
*/

$conn = Connect::getInstance(); // Retorna a váriavel de conexão PDO.

if (Connect::getError())
{
    print_r(Connect::getError());
}

?>
```

Agora vamos organizar o nosso datalayer, para isso crie uma pasta com qualquer nome, eu criei com `models`, dentro dela, crie um arquvios com o nome desejado **para seguir uma organização, use o nome da tabela.** eu criei `Test.php`. Dentro desse arquivo contem o código:

```php
<?php

namespace PedroF12\Datalayer;

class Teste extends DataLayer
{

    public function __construct()
    {
        parent::__construct("test");// Aqui vai o nome da sua tabela.
    }

}
```
Agora só chamar a sua Class `Test` que terá vários metodos.
```php
<?php

use PedroF12\Datalayer\Teste;

$teste = new Teste();

$teste->get();
$teste->get()->fetch()->foreach();
$teste->get()->fetch()->limit(2)->foreach();
$teste->get()->fetch()->findBy("first_name", 'Teste')->foreach();
$teste->get()->fetch()->findBy("first_name", 'Teste')->limit(2)->foreach();

//Count - retorna a mesma coisa só que em int, ou seja a quantidade de rows com as informações.

$teste->get()->fetch()->count();
$teste->get()->fetch()->limit(2)->count();
$teste->get()->fetch()->findBy("first_name", 'Teste')->count();
$teste->get()->fetch()->findBy("first_name", 'Teste')->limit(2)->count();

```

- `$teste->get();` - retorna todos os dados da tabela.
- `$teste->get()->fetch()->foreach();` - retorna todos os dados da tabela prontos para ser feito o foreach ou o while.
- `$teste->get()->fetch()->limit(2)->foreach();` - retorna `2` dados da tabela prontos para ser feito o foreach ou o while. 
- `$teste->get()->fetch()->findBy("first_name", 'Teste')->foreach();` - retorna todos os dados da tabela em que o `first_name` for igual a `Teste`.
- `$teste->get()->fetch()->findBy("first_name", 'Teste')->limit(2)->foreach();` - retorna 2 dados da tabela em que o `first_name` for igual a `Teste`.


# Estamos na versão 0.0.1.
Pode haver bugs ou problemas, caso ache algum, entre em contato pelo meu **discord** ``PedroF.#7734``.
