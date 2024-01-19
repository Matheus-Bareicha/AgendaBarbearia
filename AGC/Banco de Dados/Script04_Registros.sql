USE agc;

INSERT INTO cliente (nome, telefone) VALUES
  ('João Silva', 61999911111),
  ('Pedro Santos', 61999922222),
  ('Carlos Souza', 61999933333),
  ('Fernando Oliveira', 61999944444),
  ('Rafael Pereira', 61999955555),
  ('Gustavo Mendes', 62999966666),
  ('Miguel Castro', 62999977777),
  ('Gabriel Costa', 62999988888),
  ('Lucas Almeida', 62999999999),
  ('Rafael Carvalho', 61999910101);
  
  INSERT INTO barbeiro (nome, telefone, login, senha) VALUES
  ('José Barbosa', 61998877661, 'jbarbosa', '123'),
  ('Luiz Pereira', 61997788992, 'lpereira', '123'),
  ('Marcos Fernandes', 62998855633, 'mfernandes', '123'),
  ('Antônio Silva', 62994477664, 'asilva', '123'),
  ('Ricardo Oliveira', 61998833255, 'roliveira', '123'),
  ('Paulo Souza', 61992211556, 'psouza', '123'),
  ('Fernando Costa', 62991233497, 'fcosta', '123'),
  ('Leonardo Almeida', 61993366578, 'lalmeida', '123'),
  ('Alexandre Santos', 62995544789, 'asantos', '123'),
  ('Roberto Carvalho', 61996622100, 'rcarvalho', '123');
  
  INSERT INTO Agendamento (Horario, Estado, B_Login, C_Telefone) VALUES
  ('2023-06-24 09:00:00', 'R', 'jbarbosa', 61999911111),
  ('2023-06-24 09:00:00', 'X', 'lpereira', 61999922222),
  ('2023-06-24 10:00:00', 'R', 'mfernandes', 61999933333),
  ('2023-06-24 10:00:00', 'X', 'asilva', 61999944444),
  ('2023-06-24 11:00:00', 'P', 'jbarbosa', 61999955555),
  ('2023-06-24 11:00:00', 'C', 'lpereira', 62999966666),
  ('2023-06-24 14:00:00', 'P', 'mfernandes', 62999977777),
  ('2023-06-24 14:00:00', 'P', 'asilva', 62999988888),
  ('2023-06-24 15:00:00', 'P', 'jbarbosa', 61999910101),
  ('2023-06-24 15:00:00', 'C', 'lpereira', 62999999999);
  
  
 INSERT INTO folga (inicio, fim, B_Login) VALUES
  ('2023-06-25 09:00:00', '2023-06-26 09:00:00', 'roliveira'),
  ('2023-06-25 09:00:00', '2023-06-26 09:00:00', 'psouza'),
  ('2023-06-25 09:00:00', '2023-06-26 09:00:00', 'fcosta'),
  ('2023-06-25 09:00:00', '2023-06-26 09:00:00', 'lalmeida'),
  ('2023-06-25 09:00:00', '2023-06-26 09:00:00', 'asantos'),
  ('2023-06-25 09:00:00', '2023-06-26 09:00:00', 'rcarvalho'),
  ('2023-06-25 09:00:00', '2023-06-26 09:00:00', 'jbarbosa'),
  ('2023-06-25 09:00:00', '2023-06-26 09:00:00', 'lpereira'),
  ('2023-06-25 09:00:00', '2023-06-26 09:00:00', 'mfernandes'),
  ('2023-06-25 09:00:00', '2023-06-26 09:00:00', 'asilva');

  