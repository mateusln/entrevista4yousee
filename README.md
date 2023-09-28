# entrevista4yousee

Projeto desenvolvido no ubuntu 22.04, utilizando php 8.1.2 sem frameworks ou libs externas.

Rode o comando na raiz do projeto:

php -S localhost:8000

This is a challenge by Coodesh

# Processo de desenvolvimento

Antes de começar gostaria de destacar que eu fiz o projeto em PHP porque é a fullstack que eu mais domino e seria mais rápido de fazer, poderia ter feito nodejs mas eu nunca trabalhei com javascript no backend, apenas no frontent.
Como o nodejs eu teria que aprender algumas coisas de backend eu achei mais rápido fazer em PHP, mas não teria problema de fazer em node tbm.

Não utilizei nenhuma lib externa nem o composer do php para me adequar ao enunciado.

Resolvi seguir o padrão MVC (Model View Controller), pois ele me pareceu o mais adequado, sem ser muito complicado para esse caso. 

A maioria das manipulações dos dados e regras de negócio aconteceram no model na classe Plan, ele carrega o arquivo, trata os dados, faz ordenação e filtragem de acordo com o que foi pedido. Eu assumi que os dados do json seriam sempre preenchidos no mesmo padrão, por isso não fiz nenhuma verificação nesse sentido. Para gerar a tabela de planos únicos eu ordenei os planos por prioridade do mais prioritário ao menos. Percorri os planos gerando uma espécie de SKU pelo nome e localidade, caso tivesse um nome repetido eu olhava se o novo nome tinha uma data mais recente e o substitui.

Criei uma view simples para exibir os dados dos planos e uni a view e o model dentro do controller chamado PlanController, não adicionei o tratamento na exibição para formatar o dinheiro e as datas.  

O código foi feito seguindo o padrão PSR-12 do PHP.

Sobre o json poderia ser padronizado o nome em camelcase ou snake case o nome das variáveis deveria ficar em portugues ou inglês. 
