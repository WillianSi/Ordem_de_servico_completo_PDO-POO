# Ordem de serviço com PDO

<p>A aplicação permite a criação, edição, exclusão e visualização de ordens de serviço. Além disso, é possível realizar a busca por ordens de serviço específicas, utilizando filtros para encontrar os registros desejados.</p>

<p>O projeto utiliza o padrão de projeto Model-View-Controller (MVC) e a biblioteca PDO para conectar e manipular o banco de dados.</p>

<h2>Estrutura do Projeto</h2>

<p>A estrutura do projeto segue os padrões do MVC, onde:</p>

<ul>
	<li>A pasta "app" contém os modelos (Model), controladores (Controller) e as visões (View);</li>
	<li>A pasta "config" contém o arquivo de configuração do banco de dados e outras configurações gerais do projeto;</li>
	<li>A pasta "public" contém os arquivos públicos do projeto, como imagens, folhas de estilo e scripts JavaScript;</li>
	<li>A pasta "vendor" contém as bibliotecas de terceiros utilizadas no projeto;</li>
</ul>

<h2>Instalação e Configuração</h2>

<p>Para utilizar o projeto, é necessário seguir os seguintes passos:</p>

<ol>
	<li>Clonar o repositório do projeto utilizando o comando <code>git clone https://github.com/WillianSi/Ordem-de-servi-o-com-PDO.git</code>;</li>
	<li>Configurar o arquivo "config/database.php" com as informações do banco de dados utilizado;</li>
	<li>Importar o arquivo "database.sql" para o banco de dados utilizado;</li>
	<li>Iniciar o servidor web para acessar o projeto.</li>
</ol>

<h2>Utilização</h2>

<p>Após a instalação e configuração do projeto, é possível acessá-lo através de um navegador web.</p>

<p>Na página inicial do projeto é possível visualizar a lista de ordens de serviço cadastradas, com opções para criar, editar e excluir novas ordens de serviço. Também é possível realizar a busca por ordens de serviço específicas utilizando filtros.</p>
