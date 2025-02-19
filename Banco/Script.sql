-- ALTERAÇÃO DA SENHA DO USUÁRIO DO BANCO
ALTER USER postgres WITH PASSWORD '123456';

-- CRIAÇÃO DO BANCO
create database banco;

-- CRIAÇÃO DA TABELA SENSOR
create table sensor(
  id_sensor int primary key,
  descricao varchar(20) not null
);

-- CADASTRO DO SENSOR
insert into sensor (id_sensor, descricao) values(1, 'Sensor Ultrassônico');

-- CRIAÇÃO DA TABELA NIVEL
create table nivel(
  datahora timestamp not null,
  id_sensor int not null references sensor(id_sensor),
  valor int not null  
);

-- SELEÇÃO DOS DADOS
SELECT 
		n.id_sensor as "Código do Sensor", 
		s.descricao as "Descrição do Sensor",
		to_char(n.datahora, 'DD/MM/YYYY') as "Data", 
		to_char(n.datahora, 'hh24:mi:ss') as "Hora", 
		n.valor as "Nível" 
FROM nivel n 
inner join sensor s
on s.id_sensor  = n.id_sensor 
ORDER BY datahora;
