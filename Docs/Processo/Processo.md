# Processo de Desenvolvimento

O processo abaixo descreve como será desenvolvido o projeto de Métodos e Ferramentas. O mesmo foi criado baseado no modelo ágil Scrum, utilizando uma metodoligia de desenvolvimento orientado a testes, entretanto o modelo Scrum foi aplicado com algumas personalizações para adequação ao tempo disponível da equipe e também ao tipo de projeto que está sendo desenvolvido.

## Processo BMPN
Abaixo está o diagrama BPMN do processo desenvolvido:  

![processobpmn 1](https://user-images.githubusercontent.com/19656573/30466134-fb3d2176-99b1-11e7-9247-08986fd96bb9.jpg)

### Papéis
#### Product Owner
O Product Owner é a pessoa que entende o domínio do problema e os requisitos do projeto. É responsável pelo desenvolvimento do Product Backlog, esta pessoa é responsável por tirar dúvidas a respeito do problema e também por validar os itens desenvolvidos nas sprints.

#### Scrum Master
O Scrum Master é a pessoa responsável por facilitar o desenvolvimento do projeto de acordo com o processo estabelecido, ele irá acompanhar e monitorar o andamento geral da sprint e também de executar a reunião semanal com os outros membros da equipe. Além de ter essas responsabilidades, o Scrum Master também faz parte da equipe de desenvolvimento.

#### Scrum Team
O Scrum Team tem a responsabilidade de desenvolver o Backlog do Produto, os integrantes dessa equipe tem a responsabilidade de produzir as Sprin Backlogs e de executá-las, além de fazer as reuniões semanais.

### Artefatos do Processo
#### Product Backlog
O Product Backlog é um documento produzido na execução da atividade de Introdução da Visão do Produto, este documento é responsabilidade do Product Owner, nele estará disposto todas as funcionalidades que deverão ser implementadas para que o produto final esteja pronto. O backlog do produto será utilizado durante todas as sprints, e será uma referência para criação do backlog das sprints.

#### Sprint Backlog
O Sprint Backlog é um documento produzido na execução da atividade de Planejamento da Sprint, isso significa que a cada sprint que é executada, um novo backlog é produzido. Este documento irá ser desenvolvido com base nas atividades ainda não realizadas que estão no backlog do produto, será referência para indicar tudo que deverá ser produzido durante a sprint, o mesmo é uma referência para verificar se os objetivos da sprint foram atingidos ou não.

#### Backlog Revisado do Produto
Ao final de cada sprint, o backlog do produto será atualizado (indicando as tarefas já concluídas) e também poderá ser alterado e negociado com o Product Owner de acordo com novas necessidades que possam surgir no projeto. Durante a revisão da sprint esse documento deverá ser produzido (o backlog do produto atualizado).

#### Incremento do Produto
O incremento é a soma de todos os itens do Backlog do Produto que foram completados durante a Sprint junto com os incrementos de todas as Sprints anteriores. Ao final da Sprint um novo incremento deve estar “Pronto”, o que significa que deve estar na condição utilizável e atender a definição de “Pronto” do Scrum Team. Este deve estar na condição utilizável independente do Product Owner decidir por liberá-lo realmente ou não.

#### Relatório de Melhorias no Processo
Ao final de cada sprint é realizado uma renunião entre o Scrum Team para discutir os pontos que funcionaram e os que não funcionaram durante a Sprint. Caso tenha ocorrido problemas durante a sprint, o processo deverá ser atualizado para que esses problemas sejam evitados. Nesse documento deverá ser registrado as melhorias que deverão ser feitas no processo caso existam melhorias definidas pelo time.



### Atividades
#### Introduzir da Visão do Produto
Nesta atividade o produto que deverá ser desenvolvido deverá ser definido o Escopo do mesmo, então as funcionalidades que deverão existir no produto deverão ser devidamentes documentadas no Product Backlog.  
**Responsável:** Product Owner  
**Entradas:** Não se aplica  
**Saídas:** Product Backlog  



#### Planejar a Sprint
Nessa etapa uma reunião de 3 horas deverá ser feita pelo time, o backlog do produto deverá ser discutido para que seja definido quais itens do Backlog do produto serão implantados na próxima sprint. Os itens escolhidos deverão ser refinados em atividades menores, para que as mesmas sejam classificadas em complexidade e tempo, com os itens identificados e classificados os mesmos deverão ser registrados como o Backlog da Sprint.  
**Responsável:** Scrum Team  
**Entradas:** Product Backlog  
**Saídas:** Sprint Backlog  

#### Processo de Desenvolvimento
Este é um subprocesso que é executado uma vez para cada item do backlog da sprint dentro do prazo definido da sprint. A execução desse subproceso é divida em várias atividades, essas atividades são:  
**- Selecionar um item no backlog da sprint**  
**- Desenvolver os testes**  
**- Codificar**  
**- Executar os testes**  
**- Corrigir os erros**  
Estas atividades estarão descritas com maior detalhes abaixo.

#### Selecionar um item no backlog da sprint
Nesta atividade um integrante do time Scrum deverá escolher algum item do backlog para sprint para que o mesmo seja desenvolvido. Após fazer essa escolha o mesmo estará assumindo a responsabilidade de desenvolver esse item. Essa atividade deve ser executada sempre após o planejamento da print e após a finalização do item que está sendo desenvolvido, ela deve ser executada por todos os membros do time Scrum até que seja "limpo" o backlog da sprint ou então até o final do prazo de execução da sprint.  
**Responsável:** Integrante Scrum Team  
**Entradas:** Sprint Backlog  
**Saídas:** Item a ser desenvolvido  


#### Desenvolver os testes
Nesta atividade serão planejados os testes necessários para validar o item que está sendo desenvolvido. Poderão ser definidos testes de caixa preta e caixa branca. No caso de testes de caixa branca, deverão ser desenvolvidos testes unitários, então as classes e métodos que serão produzidos nessa atividade deverão ser definidos ainda na fase dos testes, para que os mesmos possam ser programados antes do próprio código. Nos testes de caixa preta, poderão ser definidos testes de usuário.
**Responsável:** Integrante Scrum Team  
**Entradas:** Item a ser desenvolvido (atividade anterior)
**Saídas:** Testes planejados e definidos

#### Codificar
Nesta atividade será realizado o desenvolvimento do item escolhido, com o objetivo de passar nos testes definidos na atividade anterior.
**Responsável:** Integrante Scrum Team  
**Entradas:** Item a ser desenvolvido e testes definidos para o item
**Saídas:** Código desenvolvido

#### Executar os testes
Nesta atividade os testes planejados anteriormente deverão ser executador no código desenvolvido na atividade anterior, após isso deverá ser definido se os testes foram satisfeitos ou não pelo código desenvolvido.
**Responsável:** Integrante Scrum Team  
**Entradas:** Testes e código fonte do item (desenvolvido ou corrigido)
**Saídas:** Resultado do teste

#### Corrigir os erros
Caso aconteça do código não passar nos testes, essa atividade deverá ser realizada. Nela o código é corrigido para que então ele consiga satisfazer os testes em uma nova tentativa. Após essa atividade a atividade de executar os testes (anterior) deverá ser realizada novamente.
**Responsável:** Integrante Scrum Team  
**Entradas:** Resultado dos testes e Código fonte defeituoso
**Saídas:** Código fonte corrigido

#### Monitoramento do Sprint Backlog
Esta atividade deverá ser executada ao mesmo tempo em que o processo de desenvolvimento ocorre, o objetivo desta atividade é assegurar que o backlog da sprint será cumprido dentro do prazo de duração da sprint. Então o backlog da sprint e o processo de desenvolvimento precisa ser monitorado para verificar se os itens estão sendo desenvolvidos no tempo definido para eles.
**Responsável:** Scrum Master 
**Entradas:** Backlog da Sprint e Processo de desenvolvimento em andamento
**Saídas:** Status de tempo da Sprint (atrasado, dentro do prazo ou adiantado)

#### Realizar uma reunião semanal
