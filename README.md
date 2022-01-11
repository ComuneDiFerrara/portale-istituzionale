# Manuale di Installazione

Comune Ferrara
## Scopo
La manualistica contenuta è puramente tecnica e per tanto **deve essere letta ed eseguita da personale esperto** onde evitare danni alla macchina che deve ospitare il software

- Si tenga conto della necessità per alcune operazioni di avere **accesso a internet** con la macchina su cui si procederà all’installazione
- Alcuni comandi richiedono l’accesso di SuperUser, si consiglia caldamente l’uso dell’utente root o di pari privilegi per eseguire questa installazione
- **Sulla base della configurazione** della macchina **alcuni percorsi potrebbero non essere corretti** e per tanto vanno verificati accuratamente prima di eseguirli
- I valori scelti nelle configurazioni di **PHP** sono valori **Raccomandati**, sta alla discrezione del tecnico se sceglierne di differenti

## Prerequisiti
- Abilitare la connessione a **internet** per il download dei pacchetti necessari
    - export http_proxy=http://reglomb.proxy:8080
    - export https_proxy=http://reglomb.proxy:8080
- Verificare che la versione di **PHP** Rispetti I requisiti (7.0.x * nei sistemi operativi RedHat potrebbe essere necessario collegare repository non ufficiali. *)
    - php -v
- Verificare che la versione di **Mysql** Rispetti I requisiti (5.7)
    - php -v
- Verificare che la versione di **Apache** Rispetti I requisiti (2.4.29 * nei sistemi operativi RedHat potrebbe essere necessario collegare repository non ufficiali. *)
    - apache2 –v

## Installazione Requisiti
- **PHP 7.0**
    - yum install rh-php70-php-intl.x86_64
    - yum install rh-php70-php-mbstring.x86_64
    - yum install rh-php70-php-bcmath.x86_64
    - yum install rh-php70-php-xml.x86_64
    - yum install rh-php70-php.x86_64
    - yum install rh-php70-intl.x86_64
    - yum install rh-php70-php-gd.x86_64
    - yum install rh-php70-php-zip.x86_64
    - yum install rh-php70-php-mysqlnd.x86_64

- **GIT**
    - yum install git.x86_64

- **Composer**
    - wget https://getcomposer.org/download/1.8.5/composer.phar
    - php composer-setup.php --install-dir=/usr/bin/
    - mv /usr/bin/composer.phar /usr/bin/composer
    - chmod +x /usr/bin/composer
    - composer –help

- **Estensioni Apache/Lighttpd**
    - rewrite

## Pre-configurazioni Macchina
Queste configurazioni devono essere eseguite per ovviare ad alcune mancanze sulla macchina fornitaci in modo da risolvere alcuni problemi che impedirebbero alla piattaforma di funzionare
- Modifica **.htaccess** in **/opt/rh/httpd24/root/var/www/html/basic-template/backend/web**
    - RewriteEngine on
    - RewriteCond %{REQUEST_FILENAME} !-f
    - RewriteCond %{REQUEST_FILENAME} !-d
    - RewriteCond $1 !^(index\.php)
    - RewriteRule (.*) index.php?$1 [PT,L,QSA]

- **Abilitazione Modulo PHP**
    - ln -s /opt/rh/httpd24/root/etc/httpd/modules/librh-php70-php7.so /etc/httpd/modules/
    - vi /etc/httpd/conf.modules.d/00-base.conf
    - vi /etc/httpd/conf/httpd.conf
    - apachectl restart

- **Configurazione PHP**
    - Configurazioni in /opt/rh/php70/root/etc/php/7.0/apache/php.ini
        - memory_limit = 4G
        - upload_max_filesize = 300M
        - post_max_size = 300M

## Installazione Piattaforma
- **Creare la directory platform nella directory www**
    - cd /opt/rh/httpd24/root/var/www/html/platform
    - cd /opt/rh/httpd24/root/var/www/html/platform

- **Creare la directory basic-template nella directory www**
    - cd /opt/rh/httpd24/root/var/www/html/basic-template
    - chown -R apache:apache /opt/rh/httpd24/root/var/www/
    - git clone https://github.com/regionelombardia-open20/basic-template.git, per scaricare la piattaforma base Open20/
    - php init –-root=/opt/rh/httpd24/root/var/www/html/platform
    - **composer update**
        - si richiede l'installazione dei plug in
    - **php yii migrate**
        - si richiede l'installazione del db

- **Installare il database vuoto**
    - **Importare nel proprio database SQL contenuto in: empty_db.sql.gz**

- **Configurazione Piattaforma**
    - vi common/config/main-local.php
         ```
         'components' => [
         'db' => [
         'class' => 'yii\db\Connection',
         'dsn' => 'mysql:host=localhost;dbname=DB_NAME_HERE',
         'username' => 'DB_USERNAME_HERE',
         'password' => 'DB_PASSWORD_HERE',
         'charset' => 'utf8',
         ],
         ```
    - vi common/config/params-local.php si modificano le email di sistema
    