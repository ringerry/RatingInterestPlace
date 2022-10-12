--
-- PostgreSQL database dump
--

-- Dumped from database version 14.5
-- Dumped by pg_dump version 14.5

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: city_town; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.city_town (
    id bigint NOT NULL,
    name text NOT NULL
);


ALTER TABLE public.city_town OWNER TO postgres;

--
-- Name: city_town_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.city_town_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.city_town_id_seq OWNER TO postgres;

--
-- Name: city_town_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.city_town_id_seq OWNED BY public.city_town.id;


--
-- Name: city_town_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.city_town_user (
    id bigint NOT NULL,
    user_id bigint,
    city_town_id bigint
);


ALTER TABLE public.city_town_user OWNER TO postgres;

--
-- Name: city_town_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.city_town_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.city_town_user_id_seq OWNER TO postgres;

--
-- Name: city_town_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.city_town_user_id_seq OWNED BY public.city_town_user.id;


--
-- Name: developer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.developer (
    id bigint NOT NULL,
    firstname text NOT NULL,
    lastname text NOT NULL,
    patronymic text NOT NULL,
    email text NOT NULL,
    password text NOT NULL
);


ALTER TABLE public.developer OWNER TO postgres;

--
-- Name: developer_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.developer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.developer_id_seq OWNER TO postgres;

--
-- Name: developer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.developer_id_seq OWNED BY public.developer.id;


--
-- Name: place; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.place (
    id bigint NOT NULL,
    name text NOT NULL,
    rating numeric,
    to_center numeric NOT NULL
);


ALTER TABLE public.place OWNER TO postgres;

--
-- Name: place_city_town; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.place_city_town (
    id bigint NOT NULL,
    city_town_id bigint,
    place_id bigint
);


ALTER TABLE public.place_city_town OWNER TO postgres;

--
-- Name: place_city_town_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.place_city_town_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.place_city_town_id_seq OWNER TO postgres;

--
-- Name: place_city_town_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.place_city_town_id_seq OWNED BY public.place_city_town.id;


--
-- Name: place_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.place_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.place_id_seq OWNER TO postgres;

--
-- Name: place_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.place_id_seq OWNED BY public.place.id;


--
-- Name: place_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.place_user (
    id bigint NOT NULL,
    user_rating integer,
    place_id bigint,
    user_id bigint
);


ALTER TABLE public.place_user OWNER TO postgres;

--
-- Name: place_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.place_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.place_user_id_seq OWNER TO postgres;

--
-- Name: place_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.place_user_id_seq OWNED BY public.place_user.id;


--
-- Name: test_table; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.test_table (
    id bigint NOT NULL,
    name text NOT NULL
);


ALTER TABLE public.test_table OWNER TO postgres;

--
-- Name: test_table_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.test_table_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.test_table_id_seq OWNER TO postgres;

--
-- Name: test_table_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.test_table_id_seq OWNED BY public.test_table.id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."user" (
    id bigint NOT NULL,
    firstname text NOT NULL,
    lastname text NOT NULL,
    patronymic text NOT NULL,
    email text NOT NULL,
    password text NOT NULL
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;


--
-- Name: city_town id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_town ALTER COLUMN id SET DEFAULT nextval('public.city_town_id_seq'::regclass);


--
-- Name: city_town_user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_town_user ALTER COLUMN id SET DEFAULT nextval('public.city_town_user_id_seq'::regclass);


--
-- Name: developer id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.developer ALTER COLUMN id SET DEFAULT nextval('public.developer_id_seq'::regclass);


--
-- Name: place id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.place ALTER COLUMN id SET DEFAULT nextval('public.place_id_seq'::regclass);


--
-- Name: place_city_town id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.place_city_town ALTER COLUMN id SET DEFAULT nextval('public.place_city_town_id_seq'::regclass);


--
-- Name: place_user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.place_user ALTER COLUMN id SET DEFAULT nextval('public.place_user_id_seq'::regclass);


--
-- Name: test_table id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.test_table ALTER COLUMN id SET DEFAULT nextval('public.test_table_id_seq'::regclass);


--
-- Name: user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);


--
-- Data for Name: city_town; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.city_town (id, name) VALUES (1, 'Кирово-Чепецк');
INSERT INTO public.city_town (id, name) VALUES (2, 'Киров');
INSERT INTO public.city_town (id, name) VALUES (5, 'Слободской');


--
-- Data for Name: city_town_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.city_town_user (id, user_id, city_town_id) VALUES (1, 1, 1);
INSERT INTO public.city_town_user (id, user_id, city_town_id) VALUES (5, 2, 1);
INSERT INTO public.city_town_user (id, user_id, city_town_id) VALUES (7, 2, 5);
INSERT INTO public.city_town_user (id, user_id, city_town_id) VALUES (8, 2, 2);


--
-- Data for Name: developer; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.developer (id, firstname, lastname, patronymic, email, password) VALUES (3, 'Святослав', 'Морозов', 'Всеволодович', 'abcd@server.ru', ';lj');


--
-- Data for Name: place; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.place (id, name, rating, to_center) VALUES (3, 'Стелла', NULL, 3);
INSERT INTO public.place (id, name, rating, to_center) VALUES (9, 'ДК Дружба', NULL, 0.5);
INSERT INTO public.place (id, name, rating, to_center) VALUES (1, 'Всехсвятский собор', 10, 1);
INSERT INTO public.place (id, name, rating, to_center) VALUES (6, 'Школа искусств', 7, 0.5);
INSERT INTO public.place (id, name, rating, to_center) VALUES (5, 'Гостиница "Двуречье"', 9.6, 0.5);
INSERT INTO public.place (id, name, rating, to_center) VALUES (4, 'Набережная', 8.5, 0.5);
INSERT INTO public.place (id, name, rating, to_center) VALUES (14, 'Пивоваренный завод', NULL, 1);
INSERT INTO public.place (id, name, rating, to_center) VALUES (16, 'Музей железнодорожного транспорта', 10, 3);
INSERT INTO public.place (id, name, rating, to_center) VALUES (13, 'Александровский сад', 9, 3);
INSERT INTO public.place (id, name, rating, to_center) VALUES (15, 'Слободской музейно-выставочный центр', 8, 7);


--
-- Data for Name: place_city_town; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.place_city_town (id, city_town_id, place_id) VALUES (1, 1, 1);
INSERT INTO public.place_city_town (id, city_town_id, place_id) VALUES (3, 1, 3);
INSERT INTO public.place_city_town (id, city_town_id, place_id) VALUES (4, 1, 4);
INSERT INTO public.place_city_town (id, city_town_id, place_id) VALUES (5, 1, 6);
INSERT INTO public.place_city_town (id, city_town_id, place_id) VALUES (8, 1, 9);
INSERT INTO public.place_city_town (id, city_town_id, place_id) VALUES (12, 2, 13);
INSERT INTO public.place_city_town (id, city_town_id, place_id) VALUES (13, 1, 5);
INSERT INTO public.place_city_town (id, city_town_id, place_id) VALUES (14, 5, 14);
INSERT INTO public.place_city_town (id, city_town_id, place_id) VALUES (15, 5, 15);
INSERT INTO public.place_city_town (id, city_town_id, place_id) VALUES (16, 2, 16);


--
-- Data for Name: place_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.place_user (id, user_rating, place_id, user_id) VALUES (3, 10, 1, 1);
INSERT INTO public.place_user (id, user_rating, place_id, user_id) VALUES (4, 8, 3, 1);
INSERT INTO public.place_user (id, user_rating, place_id, user_id) VALUES (5, 8, 4, 1);
INSERT INTO public.place_user (id, user_rating, place_id, user_id) VALUES (6, 8, 5, 1);
INSERT INTO public.place_user (id, user_rating, place_id, user_id) VALUES (7, 8, 13, 1);
INSERT INTO public.place_user (id, user_rating, place_id, user_id) VALUES (9, 10, 1, 2);
INSERT INTO public.place_user (id, user_rating, place_id, user_id) VALUES (11, 7, 6, 2);
INSERT INTO public.place_user (id, user_rating, place_id, user_id) VALUES (12, 10, 5, 2);
INSERT INTO public.place_user (id, user_rating, place_id, user_id) VALUES (17, 9, 4, 2);
INSERT INTO public.place_user (id, user_rating, place_id, user_id) VALUES (18, 8, 15, 2);
INSERT INTO public.place_user (id, user_rating, place_id, user_id) VALUES (19, 10, 16, 2);
INSERT INTO public.place_user (id, user_rating, place_id, user_id) VALUES (10, 10, 13, 2);


--
-- Data for Name: test_table; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.test_table (id, name) VALUES (1, 'Лучезар');
INSERT INTO public.test_table (id, name) VALUES (2, 'Лучезар');


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."user" (id, firstname, lastname, patronymic, email, password) VALUES (2, 'Святослав', 'Морозов', 'Всеволодович', 'abcd@server.ru', '$2y$10$SS0c0vfkdLcQHZbPNbPlPO9VqA9e9VgbcfLWNC0Ht/LBmEciP7Y3e');
INSERT INTO public."user" (id, firstname, lastname, patronymic, email, password) VALUES (1, 'Святослав', 'Морозов', 'Всеволодович', 'abc@server.ru', '$2y$10$Ke2MgDMx/fghJP9eOFPLLOjhuQmpXaRVTtK0V/tcHF99we3fQiZwi');


--
-- Name: city_town_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.city_town_id_seq', 8, true);


--
-- Name: city_town_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.city_town_user_id_seq', 8, true);


--
-- Name: developer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.developer_id_seq', 3, true);


--
-- Name: place_city_town_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.place_city_town_id_seq', 16, true);


--
-- Name: place_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.place_id_seq', 16, true);


--
-- Name: place_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.place_user_id_seq', 19, true);


--
-- Name: test_table_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.test_table_id_seq', 2, true);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_id_seq', 2, true);


--
-- Name: city_town city_town_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_town
    ADD CONSTRAINT city_town_pkey PRIMARY KEY (id);


--
-- Name: city_town_user city_town_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_town_user
    ADD CONSTRAINT city_town_user_pkey PRIMARY KEY (id);


--
-- Name: developer developer_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.developer
    ADD CONSTRAINT developer_email_key UNIQUE (email);


--
-- Name: developer developer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.developer
    ADD CONSTRAINT developer_pkey PRIMARY KEY (id);


--
-- Name: place_city_town place_city_town_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.place_city_town
    ADD CONSTRAINT place_city_town_pkey PRIMARY KEY (id);


--
-- Name: place place_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.place
    ADD CONSTRAINT place_pkey PRIMARY KEY (id);


--
-- Name: place_user place_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.place_user
    ADD CONSTRAINT place_user_pkey PRIMARY KEY (id);


--
-- Name: test_table test_table_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.test_table
    ADD CONSTRAINT test_table_pkey PRIMARY KEY (id);


--
-- Name: user user_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_email_key UNIQUE (email);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: city_town_name_uindex; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX city_town_name_uindex ON public.city_town USING btree (name);


--
-- Name: city_town_user fk_city_town_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_town_user
    ADD CONSTRAINT fk_city_town_id FOREIGN KEY (city_town_id) REFERENCES public.city_town(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: place_city_town fk_city_town_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.place_city_town
    ADD CONSTRAINT fk_city_town_id FOREIGN KEY (city_town_id) REFERENCES public.city_town(id) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: place_user fk_place_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.place_user
    ADD CONSTRAINT fk_place_id FOREIGN KEY (place_id) REFERENCES public.place(id) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: place_city_town fk_place_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.place_city_town
    ADD CONSTRAINT fk_place_id FOREIGN KEY (place_id) REFERENCES public.place(id) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: place_user fk_user_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.place_user
    ADD CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES public."user"(id) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: city_town_user fk_user_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_town_user
    ADD CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES public."user"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

