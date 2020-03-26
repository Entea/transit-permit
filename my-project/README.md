
1) Install
```
composer install
```

2) Change configs

3) Migrate
```
php bin/console doctrine:migrations:migrate
```

4) Run the server

Replace 192.168.0.108 to your local net IP. 
So you can test from smartphone that is connected to the same network by WIFI.

```
php bin/console server:run 192.168.0.108:8080
```