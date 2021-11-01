CREATE TABLE noticias
(
  id serial NOT NULL,
  data date NOT NULL,
  titulo character varying(255) NOT NULL,
  CONSTRAINT noticias_pkey PRIMARY KEY (id)
);