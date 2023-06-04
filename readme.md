# Baixe o projeto

Primeiramente, escolha um diretório de preferência e utilize o comando:
git clone url_do_projeto

# Executando o projeto

Após isso, abra o diretório do projeto, e através do seu terminal ou prompt de comando, execute o seguinte comando para iniciar o projeto e seu servidor PHP:

php -S localhost:8000 (utilize a porta de sua preferência, que esteja disponível).

Para criar e executar o banco de dados, utilize os scripts disponíveis no arquivo:

database.sql

Por fim, altere as configurações dos arquivos de config, baseado nas configurações executadas no seu ambiente, nos seguintes arquivos:

- `application/config/config.php`: Altere as configurações `$config['base_url']`, baseado na URL que está sendo executada seu projeto.

- `application/config/database.php`: Altere as configurações de hostname, username, password e database, com base nas credenciais do seu banco de dados.

# Credenciais

Login de Acesso 

Email: teste@gmail.com

Senha: senha123
