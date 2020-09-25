--
-- PostgreSQL database dump
--

-- Dumped from database version 12.4 (Ubuntu 12.4-1.pgdg18.04+1)
-- Dumped by pg_dump version 12.4 (Ubuntu 12.4-1.pgdg18.04+1)

-- Started on 2020-09-25 12:10:51 -04

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

--
-- TOC entry 3020 (class 1262 OID 16384)
-- Name: dptoEpidemi; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE "dptoEpidemi" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'es_VE.UTF-8' LC_CTYPE = 'es_VE.UTF-8';


ALTER DATABASE "dptoEpidemi" OWNER TO postgres;

\connect "dptoEpidemi"

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
-- TOC entry 202 (class 1259 OID 16385)
-- Name: usuario_bitacora; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario_bitacora (
    usuario_alias character varying(20) NOT NULL,
    id_bitacora integer DEFAULT nextval('public.bitacora_seq'::regclass) NOT NULL,
    bitacora_codigo character varying(15) NOT NULL,
    bitacora_fecha date NOT NULL,
    bitacora_hora_inicio character varying(12) NOT NULL,
    bitacora_hora_final character varying(12) DEFAULT NULL::character varying,
    bitacora_nivel_usuario integer NOT NULL,
    bitacora_year integer NOT NULL
);


ALTER TABLE public.usuario_bitacora OWNER TO postgres;

--
-- TOC entry 3014 (class 0 OID 16385)
-- Dependencies: 202
-- Data for Name: usuario_bitacora; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 1, 'CB449735042', '2020-07-27', '01:12:02 pm', '01:14:07 pm', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 2, 'CB796205572', '2020-09-15', '11:43:39 am', '11:44:05 am', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 3, 'CB911675093', '2020-09-15', '11:55:04 am', '12:03:29 pm', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 4, 'CB690809334', '2020-09-15', '12:07:45 pm', '12:08:55 pm', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 5, 'CB844330085', '2020-09-15', '12:10:41 pm', '12:10:44 pm', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 6, 'CB506847026', '2020-09-15', '12:10:44 pm', '12:13:58 pm', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 7, 'CB476822007', '2020-09-15', '12:13:58 pm', '12:14:04 pm', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 8, 'CB577767028', '2020-09-15', '12:14:04 pm', '12:14:29 pm', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 9, 'CB779976399', '2020-09-15', '12:14:32 pm', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 10, 'CB7182188010', '2020-09-15', '04:25:09 pm', '05:00:59 pm', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 11, 'CB9852765611', '2020-09-15', '05:14:02 pm', '05:14:39 pm', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 13, 'CB7339126713', '2020-09-15', '09:36:01 pm', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 14, 'CB1618617113', '2020-09-15', '09:36:01 pm', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 15, 'CB0718106615', '2020-09-15', '09:36:02 pm', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 12, 'CB2782742612', '2020-09-15', '09:35:58 pm', '09:36:02 pm', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 16, 'CB5540977216', '2020-09-15', '09:36:03 pm', '09:36:40 pm', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 17, 'CB6176735717', '2020-09-15', '10:17:05 pm', '10:17:59 pm', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 20, 'CB7957778920', '2020-09-17', '09:21:11 am', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 21, 'CB6838117019', '2020-09-17', '04:01:44 pm', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 22, 'CB5398508620', '2020-09-18', '07:12:08 am', '07:12:08 am', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 23, 'CB4664070521', '2020-09-18', '07:12:09 am', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 24, 'CB2313415122', '2020-09-18', '11:56:46 am', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 25, 'CB1268626423', '2020-09-18', '04:18:50 pm', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 26, 'CB6186665624', '2020-09-19', '08:58:57 am', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 27, 'CB5399093125', '2020-09-19', '11:09:42 am', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 28, 'CB6946507126', '2020-09-19', '11:41:16 am', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 29, 'CB2266110027', '2020-09-19', '12:21:30 pm', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 30, 'CB9394339728', '2020-09-19', '04:58:41 pm', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 31, 'CB7263243029', '2020-09-19', '06:57:19 pm', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 32, 'CB0919964430', '2020-09-20', '09:59:02 am', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 33, 'CB2057943431', '2020-09-20', '03:46:13 pm', '05:31:01 pm', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 34, 'CB9516978332', '2020-09-20', '05:31:20 pm', '05:31:54 pm', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 35, 'CB1021104633', '2020-09-20', '05:36:38 pm', '05:37:16 pm', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('calito_22', 36, 'CB5830430334', '2020-09-20', '05:37:19 pm', NULL, 2, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 37, 'CB2012548435', '2020-09-21', '09:10:39 am', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 38, 'CB9925951636', '2020-09-21', '02:54:35 pm', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 39, 'CB7016931237', '2020-09-21', '04:34:24 pm', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 40, 'CB3434370938', '2020-09-22', '04:29:55 pm', '04:29:55 pm', 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 41, 'CB8551355139', '2020-09-22', '04:29:55 pm', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 42, 'CB1102305040', '2020-09-22', '06:31:22 pm', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 43, 'CB7903625341', '2020-09-24', '04:58:56 pm', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 44, 'CB3698543042', '2020-09-25', '09:22:57 am', NULL, 1, 2020);
INSERT INTO public.usuario_bitacora (usuario_alias, id_bitacora, bitacora_codigo, bitacora_fecha, bitacora_hora_inicio, bitacora_hora_final, bitacora_nivel_usuario, bitacora_year) VALUES ('newman206', 45, 'CB3497482143', '2020-09-25', '10:28:11 am', NULL, 1, 2020);


--
-- TOC entry 2886 (class 2606 OID 16430)
-- Name: usuario_bitacora bitacora_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_bitacora
    ADD CONSTRAINT bitacora_pkey PRIMARY KEY (id_bitacora);


--
-- TOC entry 2887 (class 2606 OID 16490)
-- Name: usuario_bitacora bitacora_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_bitacora
    ADD CONSTRAINT bitacora_ibfk_1 FOREIGN KEY (usuario_alias) REFERENCES public.usuarios(alias) ON UPDATE CASCADE ON DELETE CASCADE;


-- Completed on 2020-09-25 12:10:53 -04

--
-- PostgreSQL database dump complete
--

