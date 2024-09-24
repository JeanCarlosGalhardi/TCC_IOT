ALTER USER postgres WITH PASSWORD '123456';

-- CRIAÇÃO DO BANCO
create database banco;

-- CRIAÇÃO DA TABELA SENSOR
create table sensor(
  id_sensor int primary key,
  descricao varchar(20) not null
);

-- CADASTRO DO PRIMEIRO SENSOR
insert into sensor (id_sensor, descricao) values(1, 'Sensor 1');

-- CRIAÇÃO DA TABELA NIVEL
create table nivel(
  datahora timestamp not null,
  id_sensor int not null references sensor(id_sensor),
  valor int not null  
);

-- EXEMPLO DE INSERT
insert into nivel (datahora, id_sensor, valor) values (now(), 1, 9);

-- EXEMPLO DE SELECT
select to_char(datahora, 'dd/mm/yyyy hh24:mi'), id_sensor, valor from nivel;

delete from nivel