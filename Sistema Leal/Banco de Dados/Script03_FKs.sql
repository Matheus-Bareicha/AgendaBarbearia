USE agc;

ALTER TABLE Agendamento
ADD CONSTRAINT fk_cliente_agendamento
FOREIGN KEY (C_Telefone)
REFERENCES Cliente (Telefone);

ALTER TABLE Agendamento
ADD CONSTRAINT fk_barbeiro_agendamento
FOREIGN KEY (B_Login)
REFERENCES Barbeiro (Login);

ALTER TABLE Folga
ADD CONSTRAINT fk_barbeiro_folga
FOREIGN KEY (B_Login)
REFERENCES Barbeiro (Login);