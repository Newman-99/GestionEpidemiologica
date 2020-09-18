--
-- PostgreSQL database dump
--

-- Dumped from database version 12.4 (Ubuntu 12.4-1.pgdg18.04+1)
-- Dumped by pg_dump version 12.4 (Ubuntu 12.4-1.pgdg18.04+1)

-- Started on 2020-09-18 09:15:03 -04

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
-- TOC entry 3087 (class 1262 OID 16384)
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

--
-- TOC entry 214 (class 1259 OID 16472)
-- Name: bitacora_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.bitacora_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bitacora_seq OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 203 (class 1259 OID 16389)
-- Name: casos_epidemiologicos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.casos_epidemiologicos (
    id_caso_epidemiologico integer DEFAULT nextval('public.bitacora_seq'::regclass) NOT NULL,
    doc_identidad character varying(15) NOT NULL,
    catalog_key_cie10 character varying(5) NOT NULL,
    id_parroquia integer NOT NULL,
    direccion character varying(200) NOT NULL,
    telefono character varying(11) NOT NULL,
    fecha date NOT NULL
);


ALTER TABLE public.casos_epidemiologicos OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 16475)
-- Name: casos_epidemiologicos_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.casos_epidemiologicos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.casos_epidemiologicos_seq OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 16659)
-- Name: data_cie10; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.data_cie10 (
    consecutivo integer NOT NULL,
    letra character varying(1) NOT NULL,
    catalog_key character varying(5) NOT NULL,
    nombre character varying(300) NOT NULL,
    codigox character varying(2) NOT NULL,
    lsex character varying(2) NOT NULL,
    linf character varying(4) NOT NULL,
    lsup character varying(4) NOT NULL,
    trivial character varying(2) NOT NULL,
    erradicado character varying(2) NOT NULL,
    n_inter character varying(2) NOT NULL,
    nin character varying(2) NOT NULL,
    ninmtobs character varying(2) NOT NULL,
    cod_sit_lesion character varying(2) NOT NULL,
    no_cbd character varying(2) NOT NULL,
    cbd character varying(2) NOT NULL,
    no_aph character varying(2) NOT NULL,
    af_prin character varying(2) NOT NULL,
    dia_sis character varying(2) NOT NULL,
    clave_programa_sis character varying(2) NOT NULL,
    cod_complemen_morbi character varying(2) NOT NULL,
    def_fetal_cm character varying(2) NOT NULL,
    def_fetal_cbd character varying(2) NOT NULL,
    clave_capitulo character varying(2) NOT NULL,
    capitulo character varying(200) NOT NULL,
    lista1 character varying(3) NOT NULL,
    grupo1 character varying(3) NOT NULL,
    lista5 character varying(3) NOT NULL,
    rubrica_type character varying(3) NOT NULL,
    year_modifi character varying(150) NOT NULL,
    year_aplicacion character varying(4) NOT NULL,
    valid character varying(2) NOT NULL,
    prinmorta character varying(4) NOT NULL,
    prinmorbi character varying(4) NOT NULL,
    lm_morbi character varying(4) NOT NULL,
    lm_morta character varying(5) NOT NULL,
    lgbd165 character varying(3) NOT NULL,
    lomsbeck character varying(3) NOT NULL,
    lgbd190 character varying(3) NOT NULL,
    notdiaria character varying(2) NOT NULL,
    notsemanal character varying(2) NOT NULL,
    sistema_especial character varying(2) NOT NULL,
    birmm character varying(2) NOT NULL,
    cve_causa_type character varying(2) NOT NULL,
    causa_type character varying(50) NOT NULL,
    epi_morta character varying(2) NOT NULL,
    edas_e_iras_en_m5 character varying(2) NOT NULL,
    csve_maternas_seed_epid character varying(2) NOT NULL,
    epi_morta_m5 character varying(2) NOT NULL,
    epi_morbi character varying(2) NOT NULL,
    def_maternas character varying(3) NOT NULL,
    es_causes character varying(2) NOT NULL,
    num_causes character varying(3) NOT NULL,
    es_suive_morta character varying(2) NOT NULL,
    es_suive_morb character varying(2) NOT NULL,
    epi_clave character varying(5) NOT NULL,
    epi_clave_desc character varying(120) NOT NULL,
    es_suive_notin character varying(2) NOT NULL,
    es_suive_est_epi character varying(2) NOT NULL,
    es_suive_est_brote character varying(2) NOT NULL,
    sinac character varying(2) NOT NULL,
    prin_sinac character varying(3) NOT NULL,
    prin_sinac_grupo character varying(2) NOT NULL,
    descripcion_sinac_grupo character varying(180) NOT NULL,
    prin_sinac_subgrupo character varying(3) NOT NULL,
    descripcion_sinac_subgrupo character varying(180) NOT NULL,
    daga character varying(2) NOT NULL,
    asterisco character varying(2) NOT NULL
);


ALTER TABLE public.data_cie10 OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 16398)
-- Name: generos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.generos (
    id_genero integer NOT NULL,
    descripcion_genero character varying(20) NOT NULL
);


ALTER TABLE public.generos OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 16401)
-- Name: nacionalidades; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.nacionalidades (
    id_nacionalidad integer NOT NULL,
    descripcion_nacionalidad character varying(20) NOT NULL
);


ALTER TABLE public.nacionalidades OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 16480)
-- Name: parroquias_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.parroquias_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.parroquias_seq OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 16404)
-- Name: parroquias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.parroquias (
    id_parroquia integer DEFAULT nextval('public.parroquias_seq'::regclass) NOT NULL,
    id_municipio integer NOT NULL,
    parroquia character varying(250) NOT NULL
);


ALTER TABLE public.parroquias OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 16407)
-- Name: personas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personas (
    doc_identidad character varying(15) NOT NULL,
    nombres character varying(50) NOT NULL,
    apellidos character varying(50) NOT NULL,
    fecha_nacimiento date NOT NULL,
    id_nacionalidad integer NOT NULL,
    id_genero integer NOT NULL
);


ALTER TABLE public.personas OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 16410)
-- Name: plantilla_informe; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.plantilla_informe (
    id_plantilla_informe integer NOT NULL,
    ubicacion_informe character varying(300) NOT NULL
);


ALTER TABLE public.plantilla_informe OWNER TO postgres;

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
-- TOC entry 209 (class 1259 OID 16413)
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    alias character varying(20) NOT NULL,
    id_nacionalidad integer NOT NULL,
    doc_identidad character varying(15) NOT NULL,
    id_nivel_permiso integer NOT NULL,
    id_estado integer NOT NULL,
    pass_encrypt character varying(130) NOT NULL,
    email character varying(100) NOT NULL,
    telefono character varying(11) NOT NULL
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 16416)
-- Name: usuarios_estados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios_estados (
    id_estado integer NOT NULL,
    descripcion_estado character varying(20) NOT NULL
);


ALTER TABLE public.usuarios_estados OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 16419)
-- Name: usuarios_niveles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios_niveles (
    id_nivel_permiso integer NOT NULL,
    descripcion_nivel_permiso character varying(20) NOT NULL
);


ALTER TABLE public.usuarios_niveles OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 16422)
-- Name: usuarios_preguntas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios_preguntas (
    usuario_alias character varying(20) NOT NULL,
    id_pregunta integer NOT NULL,
    respuesta character varying(150) NOT NULL
);


ALTER TABLE public.usuarios_preguntas OWNER TO postgres;

--
-- TOC entry 213 (class 1259 OID 16425)
-- Name: usuarios_preguntas_disponibles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios_preguntas_disponibles (
    id_pregunta integer NOT NULL,
    descripcion character varying(50) NOT NULL
);


ALTER TABLE public.usuarios_preguntas_disponibles OWNER TO postgres;

--
-- TOC entry 3067 (class 0 OID 16389)
-- Dependencies: 203
-- Data for Name: casos_epidemiologicos; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3081 (class 0 OID 16659)
-- Dependencies: 217
-- Data for Name: data_cie10; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (1, 'A', 'A00', 'CÓLERA', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'NO', 'NO', 'SI', 'SI', 'NO', 'NO', 'NA', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '002', '001', '001', 'NO', 'NO', 'NO', 'SI', '001', '001', 'NO', 'NO', 'NO', '1', 'NO', 'SI', 'SI', 'SI', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'NO', 'NO', 'NO', 'SI', '0', 'NO', 'NO', 'NO', 'SI', 'NO', 'NO', 'SI', 'SI', 'SI', 'NO', '000', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (2, 'A', 'A000', 'CÓLERA DEBIDO A VIBRIO CHOLERAE 01, BIOTIPO CHOLERAE', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'NO', 'NO', 'SI', 'NO', 'SI', 'SI', '1', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '002', '001', '001', 'NO', 'NO', 'NO', 'SI', '001', '001', ' 01A', ' 01A', '10', '1', '10', 'SI', 'SI', 'SI', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'SI', 'NO', 'NO', 'NO', 'SI', '0', 'NO', 'NO', 'SI', 'SI', '01', 'COLERA', 'SI', 'SI', 'SI', 'NO', '999', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (3, 'A', 'A001', 'CÓLERA DEBIDO A VIBRIO CHOLERAE 01, BIOTIPO EL TOR', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'NO', 'NO', 'SI', 'NO', 'SI', 'SI', '1', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '002', '001', '001', 'NO', 'NO', 'NO', 'SI', '001', '001', ' 01A', ' 01A', '10', '1', '10', 'SI', 'SI', 'SI', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'SI', 'NO', 'NO', 'NO', 'SI', '0', 'NO', 'NO', 'SI', 'SI', '01', 'COLERA', 'SI', 'SI', 'SI', 'NO', '999', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (4, 'A', 'A009', 'CÓLERA, NO ESPECIFICADO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'NO', 'NO', 'SI', 'NO', 'SI', 'SI', '1', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '002', '001', '001', 'NO', 'NO', 'NO', 'SI', '001', '001', ' 01A', ' 01A', '10', '1', '10', 'SI', 'SI', 'SI', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'SI', 'NO', 'NO', 'NO', 'SI', '0', 'NO', 'NO', 'SI', 'SI', '01', 'COLERA', 'SI', 'SI', 'SI', 'NO', '999', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (5, 'A', 'A01', 'FIEBRES TIFOIDEA Y PARATIFOIDEA', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'SI', 'NO', 'NO', 'NA', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '004', '001', '002', 'NO', 'NO', 'NO', 'SI', '001', '001', 'NO', 'NO', 'NO', '1', 'NO', 'NO', 'NO', 'NO', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'NO', 'NO', 'NO', 'NO', '0', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', '000', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (6, 'A', 'A010', 'FIEBRE TIFOIDEA', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'SI', 'SI', '1', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '004', '001', '002', 'NO', 'NO', 'NO', 'SI', '001', '001', ' 01B', ' 01B', '10', '1', '10', 'NO', 'SI', 'NO', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'SI', 'NO', 'SI', 'SI', '0', 'SI', '57', 'SI', 'SI', '06', 'FIEBRE TIFOIDEA', 'NO', 'NO', 'SI', 'NO', '999', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (7, 'A', 'A011', 'FIEBRE PARATIFOIDEA A', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'SI', 'SI', '1', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '004', '001', '002', 'NO', 'NO', 'NO', 'SI', '001', '001', ' 01C', ' 01C', '10', '1', '10', 'NO', 'SI', 'NO', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'SI', 'NO', 'SI', 'SI', '0', 'SI', '56', 'SI', 'SI', '178', 'FIEBRE PARATIFOIDEA', 'NO', 'NO', 'NO', 'NO', '999', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (8, 'A', 'A012', 'FIEBRE PARATIFOIDEA B', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'SI', 'SI', '1', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '004', '001', '002', 'NO', 'NO', 'NO', 'SI', '001', '001', ' 01C', ' 01C', '10', '1', '10', 'NO', 'NO', 'NO', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'SI', 'NO', 'NO', 'NO', '0', 'SI', '56', 'NO', 'NO', '178', 'FIEBRE PARATIFOIDEA', 'NO', 'NO', 'NO', 'NO', '999', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (9, 'A', 'A013', 'FIEBRE PARATIFOIDEA C', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'SI', 'SI', '1', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '004', '001', '002', 'NO', 'NO', 'NO', 'SI', '001', '001', ' 01C', ' 01C', '10', '1', '10', 'NO', 'NO', 'NO', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'SI', 'NO', 'NO', 'NO', '0', 'SI', '56', 'NO', 'NO', '178', 'FIEBRE PARATIFOIDEA', 'NO', 'NO', 'NO', 'NO', '999', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (10, 'A', 'A014', 'FIEBRE PARATIFOIDEA, NO ESPECIFICADA', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'SI', 'SI', '1', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '004', '001', '002', 'NO', 'NO', 'NO', 'SI', '001', '001', ' 01C', ' 01C', '10', '1', '10', 'NO', 'NO', 'NO', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'SI', 'NO', 'NO', 'NO', '0', 'SI', '56', 'NO', 'NO', '178', 'FIEBRE PARATIFOIDEA', 'NO', 'NO', 'NO', 'NO', '999', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (11, 'A', 'A02', 'OTRAS INFECCIONES DEBIDAS A SALMONELLA', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'SI', 'NO', 'NO', 'NA', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '004', '001', '006', 'NO', 'NO', 'NO', 'SI', '001', '001', 'NO', 'NO', 'NO', '1', 'NO', 'NO', 'SI', 'NO', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'SI', 'NO', 'NO', 'SI', '0', 'NO', 'NO', 'NO', 'SI', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', '000', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (12, 'A', 'A020', 'ENTERITIS DEBIDA A SALMONELLA', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'SI', 'SI', '1', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '004', '001', '006', 'NO', 'NO', 'NO', 'SI', '001', '001', ' 01E', ' 01E', '10', '1', '10', 'NO', 'NO', 'NO', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'SI', 'NO', 'SI', 'SI', '0', 'SI', '56', 'SI', 'SI', '177', 'OTRAS SALMONELOSIS', 'NO', 'NO', 'NO', 'NO', '999', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (13, 'A', 'A021', 'SEPSIS DEBIDA A SALMONELLA', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'SI', 'SI', '1', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '004', '001', '006', 'C', '2010 CORRECCION TITULOS', '2014', 'SI', '001', '001', ' 01E', ' 01E', '10', '1', '10', 'NO', 'NO', 'NO', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'SI', 'NO', 'SI', 'SI', '0', 'NO', 'NO', 'SI', 'SI', '177', 'OTRAS SALMONELOSIS', 'NO', 'NO', 'NO', 'NO', '999', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (14, 'A', 'A022', 'INFECCIONES LOCALIZADAS DEBIDAS A SALMONELLA', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'SI', 'SI', '1', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '004', '001', '006', 'C', '2003 (SE ELIMINO DAGA)', '2003', 'SI', '001', '001', ' 01E', ' 01E', '10', '1', '10', 'NO', 'NO', 'NO', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'SI', 'NO', 'SI', 'SI', '0', 'NO', 'NO', 'SI', 'SI', '177', 'OTRAS SALMONELOSIS', 'NO', 'NO', 'NO', 'NO', '999', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (15, 'A', 'A028', 'OTRAS INFECCIONES ESPECIFICADAS COMO DEBIDAS A SALMONELLA', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'SI', 'SI', '1', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '004', '001', '006', 'NO', 'NO', 'NO', 'SI', '001', '001', ' 01E', ' 01E', '10', '1', '10', 'NO', 'NO', 'NO', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'SI', 'NO', 'SI', 'SI', '0', 'NO', 'NO', 'SI', 'SI', '177', 'OTRAS SALMONELOSIS', 'NO', 'NO', 'NO', 'NO', '999', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (16, 'A', 'A029', 'INFECCIÓN DEBIDA A SALMONELLA, NO ESPECIFICADA', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'SI', 'SI', '1', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '004', '001', '006', 'NO', 'NO', 'NO', 'SI', '001', '001', ' 01E', ' 01E', '10', '1', '10', 'NO', 'NO', 'NO', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'SI', 'NO', 'SI', 'SI', '0', 'NO', 'NO', 'SI', 'SI', '177', 'OTRAS SALMONELOSIS', 'NO', 'NO', 'NO', 'NO', '999', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (17, 'A', 'A03', 'SHIGELOSIS', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'SI', 'NO', 'NO', 'NA', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '004', '001', '003', 'NO', 'NO', 'NO', 'SI', '001', '001', 'NO', 'NO', 'NO', '1', 'NO', 'NO', 'SI', 'NO', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'SI', 'NO', 'NO', 'SI', '0', 'NO', 'NO', 'NO', 'SI', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', '000', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (18, 'A', 'A030', 'SHIGELOSIS DEBIDA A SHIGELLA DYSENTERIAE', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'SI', 'SI', '1', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '004', '001', '003', 'NO', 'NO', 'NO', 'SI', '001', '001', ' 01D', ' 01D', '10', '1', '10', 'NO', 'NO', 'NO', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'SI', 'NO', 'SI', 'SI', '0', 'NO', 'NO', 'SI', 'SI', '05', 'SHIGELOSIS', 'NO', 'NO', 'NO', 'NO', '999', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO public.data_cie10 (consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco) VALUES (19, 'A', 'A031', 'SHIGELOSIS DEBIDA A SHIGELLA FLEXNERI', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'SI', 'SI', '1', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '004', '001', '003', 'NO', 'NO', 'NO', 'SI', '001', '001', ' 01D', ' 01D', '10', '1', '10', 'NO', 'NO', 'NO', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'SI', 'NO', 'SI', 'SI', '0', 'NO', 'NO', 'SI', 'SI', '05', 'SHIGELOSIS', 'NO', 'NO', 'NO', 'NO', '999', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');


--
-- TOC entry 3068 (class 0 OID 16398)
-- Dependencies: 204
-- Data for Name: generos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.generos (id_genero, descripcion_genero) VALUES (1, 'Masculino');
INSERT INTO public.generos (id_genero, descripcion_genero) VALUES (2, 'Femenino');


--
-- TOC entry 3069 (class 0 OID 16401)
-- Dependencies: 205
-- Data for Name: nacionalidades; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.nacionalidades (id_nacionalidad, descripcion_nacionalidad) VALUES (1, 'Venezolano/a');
INSERT INTO public.nacionalidades (id_nacionalidad, descripcion_nacionalidad) VALUES (2, 'Extrangero/a');


--
-- TOC entry 3070 (class 0 OID 16404)
-- Dependencies: 206
-- Data for Name: parroquias; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1, 1, 'Alto Orinoco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (2, 1, 'Huachamacare Acanaña');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (3, 1, 'Marawaka Toky Shamanaña');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (4, 1, 'Mavaka Mavaka');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (5, 1, 'Sierra Parima Parimabé');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (6, 2, 'Ucata Laja Lisa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (7, 2, 'Yapacana Macuruco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (8, 2, 'Caname Guarinuma');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (9, 3, 'Fernando Girón Tovar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (10, 3, 'Luis Alberto Gómez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (11, 3, 'Pahueña Limón de Parhueña');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (12, 3, 'Platanillal Platanillal');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (13, 4, 'Samariapo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (14, 4, 'Sipapo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (15, 4, 'Munduapo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (16, 4, 'Guayapo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (17, 5, 'Alto Ventuari');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (18, 5, 'Medio Ventuari');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (19, 5, 'Bajo Ventuari');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (20, 6, 'Victorino');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (21, 6, 'Comunidad');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (22, 7, 'Casiquiare');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (23, 7, 'Cocuy');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (24, 7, 'San Carlos de Río Negro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (25, 7, 'Solano');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (26, 8, 'Anaco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (27, 8, 'San Joaquín');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (28, 9, 'Cachipo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (29, 9, 'Aragua de Barcelona');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (30, 11, 'Lechería');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (31, 11, 'El Morro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (32, 12, 'Puerto Píritu');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (33, 12, 'San Miguel');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (34, 12, 'Sucre');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (35, 13, 'Valle de Guanape');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (36, 13, 'Santa Bárbara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (37, 14, 'El Chaparro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (38, 14, 'Tomás Alfaro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (39, 14, 'Calatrava');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (40, 15, 'Guanta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (41, 15, 'Chorrerón');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (42, 16, 'Mamo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (43, 16, 'Soledad');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (44, 17, 'Mapire');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (45, 17, 'Piar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (46, 17, 'Santa Clara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (47, 17, 'San Diego de Cabrutica');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (48, 17, 'Uverito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (49, 17, 'Zuata');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (50, 18, 'Puerto La Cruz');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (51, 18, 'Pozuelos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (52, 19, 'Onoto');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (53, 19, 'San Pablo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (54, 20, 'San Mateo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (55, 20, 'El Carito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (56, 20, 'Santa Inés');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (57, 20, 'La Romereña');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (58, 21, 'Atapirire');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (59, 21, 'Boca del Pao');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (60, 21, 'El Pao');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (61, 21, 'Pariaguán');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (62, 22, 'Cantaura');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (63, 22, 'Libertador');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (64, 22, 'Santa Rosa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (65, 22, 'Urica');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (66, 23, 'Píritu');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (67, 23, 'San Francisco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (68, 24, 'San José de Guanipa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (69, 25, 'Boca de Uchire');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (70, 25, 'Boca de Chávez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (71, 26, 'Pueblo Nuevo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (72, 26, 'Santa Ana');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (73, 27, 'Bergantín');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (74, 27, 'Caigua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (75, 27, 'El Carmen');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (76, 27, 'El Pilar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (77, 27, 'Naricual');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (78, 27, 'San Crsitóbal');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (79, 28, 'Edmundo Barrios');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (80, 28, 'Miguel Otero Silva');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (81, 29, 'Achaguas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (82, 29, 'Apurito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (83, 29, 'El Yagual');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (84, 29, 'Guachara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (85, 29, 'Mucuritas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (86, 29, 'Queseras del medio');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (87, 30, 'Biruaca');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (88, 31, 'Bruzual');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (89, 31, 'Mantecal');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (90, 31, 'Quintero');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (91, 31, 'Rincón Hondo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (92, 31, 'San Vicente');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (93, 32, 'Guasdualito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (94, 32, 'Aramendi');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (95, 32, 'El Amparo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (96, 32, 'San Camilo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (97, 32, 'Urdaneta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (98, 33, 'San Juan de Payara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (99, 33, 'Codazzi');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (100, 33, 'Cunaviche');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (101, 34, 'Elorza');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (102, 34, 'La Trinidad');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (103, 35, 'San Fernando');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (104, 35, 'El Recreo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (105, 35, 'Peñalver');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (106, 35, 'San Rafael de Atamaica');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (107, 36, 'Pedro José Ovalles');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (108, 36, 'Joaquín Crespo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (109, 36, 'José Casanova Godoy');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (110, 36, 'Madre María de San José');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (111, 36, 'Andrés Eloy Blanco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (112, 36, 'Los Tacarigua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (113, 36, 'Las Delicias');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (114, 36, 'Choroní');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (115, 37, 'Bolívar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (116, 38, 'Camatagua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (117, 38, 'Carmen de Cura');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (118, 39, 'Santa Rita');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (119, 39, 'Francisco de Miranda');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (120, 39, 'Moseñor Feliciano González');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (121, 40, 'Santa Cruz');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (122, 41, 'José Félix Ribas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (123, 41, 'Castor Nieves Ríos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (124, 41, 'Las Guacamayas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (125, 41, 'Pao de Zárate');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (126, 41, 'Zuata');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (127, 42, 'José Rafael Revenga');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (128, 43, 'Palo Negro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (129, 43, 'San Martín de Porres');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (130, 44, 'El Limón');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (131, 44, 'Caña de Azúcar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (132, 45, 'Ocumare de la Costa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (133, 46, 'San Casimiro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (134, 46, 'Güiripa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (135, 46, 'Ollas de Caramacate');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (136, 46, 'Valle Morín');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (137, 47, 'San Sebastían');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (138, 48, 'Turmero');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (139, 48, 'Arevalo Aponte');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (140, 48, 'Chuao');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (141, 48, 'Samán de Güere');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (142, 48, 'Alfredo Pacheco Miranda');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (143, 49, 'Santos Michelena');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (144, 49, 'Tiara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (145, 50, 'Cagua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (146, 50, 'Bella Vista');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (147, 51, 'Tovar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (148, 52, 'Urdaneta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (149, 52, 'Las Peñitas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (150, 52, 'San Francisco de Cara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (151, 52, 'Taguay');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (152, 53, 'Zamora');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (153, 53, 'Magdaleno');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (154, 53, 'San Francisco de Asís');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (155, 53, 'Valles de Tucutunemo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (156, 53, 'Augusto Mijares');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (157, 54, 'Sabaneta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (158, 54, 'Juan Antonio Rodríguez Domínguez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (159, 55, 'El Cantón');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (160, 55, 'Santa Cruz de Guacas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (161, 55, 'Puerto Vivas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (162, 56, 'Ticoporo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (163, 56, 'Nicolás Pulido');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (164, 56, 'Andrés Bello');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (165, 57, 'Arismendi');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (166, 57, 'Guadarrama');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (167, 57, 'La Unión');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (168, 57, 'San Antonio');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (169, 58, 'Barinas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (170, 58, 'Alberto Arvelo Larriva');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (171, 58, 'San Silvestre');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (172, 58, 'Santa Inés');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (173, 58, 'Santa Lucía');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (174, 58, 'Torumos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (175, 58, 'El Carmen');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (176, 58, 'Rómulo Betancourt');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (177, 58, 'Corazón de Jesús');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (178, 58, 'Ramón Ignacio Méndez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (179, 58, 'Alto Barinas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (180, 58, 'Manuel Palacio Fajardo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (181, 58, 'Juan Antonio Rodríguez Domínguez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (182, 58, 'Dominga Ortiz de Páez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (183, 59, 'Barinitas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (184, 59, 'Altamira de Cáceres');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (185, 59, 'Calderas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (186, 60, 'Barrancas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (187, 60, 'El Socorro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (188, 60, 'Mazparrito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (189, 61, 'Santa Bárbara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (190, 61, 'Pedro Briceño Méndez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (191, 61, 'Ramón Ignacio Méndez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (192, 61, 'José Ignacio del Pumar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (193, 62, 'Obispos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (194, 62, 'Guasimitos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (195, 62, 'El Real');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (196, 62, 'La Luz');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (197, 63, 'Ciudad Bolívia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (198, 63, 'José Ignacio Briceño');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (199, 63, 'José Félix Ribas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (200, 63, 'Páez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (201, 64, 'Libertad');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (202, 64, 'Dolores');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (203, 64, 'Santa Rosa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (204, 64, 'Palacio Fajardo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (205, 65, 'Ciudad de Nutrias');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (206, 65, 'El Regalo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (207, 65, 'Puerto Nutrias');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (208, 65, 'Santa Catalina');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (209, 66, 'Cachamay');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (210, 66, 'Chirica');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (211, 66, 'Dalla Costa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (212, 66, 'Once de Abril');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (213, 66, 'Simón Bolívar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (214, 66, 'Unare');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (215, 66, 'Universidad');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (216, 66, 'Vista al Sol');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (217, 66, 'Pozo Verde');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (218, 66, 'Yocoima');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (219, 66, '5 de Julio');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (220, 67, 'Cedeño');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (221, 67, 'Altagracia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (222, 67, 'Ascensión Farreras');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (223, 67, 'Guaniamo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (224, 67, 'La Urbana');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (225, 67, 'Pijiguaos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (226, 68, 'El Callao');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (227, 69, 'Gran Sabana');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (228, 69, 'Ikabarú');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (229, 70, 'Catedral');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (230, 70, 'Zea');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (231, 70, 'Orinoco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (232, 70, 'José Antonio Páez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (233, 70, 'Marhuanta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (234, 70, 'Agua Salada');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (235, 70, 'Vista Hermosa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (236, 70, 'La Sabanita');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (237, 70, 'Panapana');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (238, 71, 'Andrés Eloy Blanco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (239, 71, 'Pedro Cova');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (240, 72, 'Raúl Leoni');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (241, 72, 'Barceloneta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (242, 72, 'Santa Bárbara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (243, 72, 'San Francisco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (244, 73, 'Roscio');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (245, 73, 'Salóm');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (246, 74, 'Sifontes');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (247, 74, 'Dalla Costa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (248, 74, 'San Isidro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (249, 75, 'Sucre');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (250, 75, 'Aripao');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (251, 75, 'Guarataro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (252, 75, 'Las Majadas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (253, 75, 'Moitaco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (254, 76, 'Padre Pedro Chien');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (255, 76, 'Río Grande');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (256, 77, 'Bejuma');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (257, 77, 'Canoabo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (258, 77, 'Simón Bolívar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (259, 78, 'Güigüe');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (260, 78, 'Carabobo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (261, 78, 'Tacarigua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (262, 79, 'Mariara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (263, 79, 'Aguas Calientes');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (264, 80, 'Ciudad Alianza');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (265, 80, 'Guacara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (266, 80, 'Yagua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (267, 81, 'Morón');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (268, 81, 'Yagua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (269, 82, 'Tocuyito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (270, 82, 'Independencia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (271, 83, 'Los Guayos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (272, 84, 'Miranda');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (273, 85, 'Montalbán');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (274, 86, 'Naguanagua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (275, 87, 'Bartolomé Salóm');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (276, 87, 'Democracia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (277, 87, 'Fraternidad');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (278, 87, 'Goaigoaza');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (279, 87, 'Juan José Flores');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (280, 87, 'Unión');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (281, 87, 'Borburata');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (282, 87, 'Patanemo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (283, 88, 'San Diego');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (284, 89, 'San Joaquín');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (285, 90, 'Candelaria');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (286, 90, 'Catedral');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (287, 90, 'El Socorro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (288, 90, 'Miguel Peña');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (289, 90, 'Rafael Urdaneta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (290, 90, 'San Blas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (291, 90, 'San José');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (292, 90, 'Santa Rosa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (293, 90, 'Negro Primero');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (294, 91, 'Cojedes');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (295, 91, 'Juan de Mata Suárez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (296, 92, 'Tinaquillo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (297, 93, 'El Baúl');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (298, 93, 'Sucre');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (299, 94, 'La Aguadita');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (300, 94, 'Macapo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (301, 95, 'El Pao');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (302, 96, 'El Amparo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (303, 96, 'Libertad de Cojedes');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (304, 97, 'Rómulo Gallegos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (305, 98, 'San Carlos de Austria');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (306, 98, 'Juan Ángel Bravo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (307, 98, 'Manuel Manrique');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (308, 99, 'General en Jefe José Laurencio Silva');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (309, 100, 'Curiapo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (310, 100, 'Almirante Luis Brión');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (311, 100, 'Francisco Aniceto Lugo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (312, 100, 'Manuel Renaud');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (313, 100, 'Padre Barral');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (314, 100, 'Santos de Abelgas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (315, 101, 'Imataca');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (316, 101, 'Cinco de Julio');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (317, 101, 'Juan Bautista Arismendi');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (318, 101, 'Manuel Piar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (319, 101, 'Rómulo Gallegos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (320, 102, 'Pedernales');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (321, 102, 'Luis Beltrán Prieto Figueroa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (322, 103, 'San José (Delta Amacuro)');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (323, 103, 'José Vidal Marcano');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (324, 103, 'Juan Millán');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (325, 103, 'Leonardo Ruíz Pineda');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (326, 103, 'Mariscal Antonio José de Sucre');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (327, 103, 'Monseñor Argimiro García');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (328, 103, 'San Rafael (Delta Amacuro)');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (329, 103, 'Virgen del Valle');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (330, 10, 'Clarines');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (331, 10, 'Guanape');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (332, 10, 'Sabana de Uchire');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (333, 104, 'Capadare');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (334, 104, 'La Pastora');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (335, 104, 'Libertador');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (336, 104, 'San Juan de los Cayos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (337, 105, 'Aracua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (338, 105, 'La Peña');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (339, 105, 'San Luis');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (340, 106, 'Bariro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (341, 106, 'Borojó');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (342, 106, 'Capatárida');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (343, 106, 'Guajiro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (344, 106, 'Seque');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (345, 106, 'Zazárida');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (346, 106, 'Valle de Eroa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (347, 107, 'Cacique Manaure');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (348, 108, 'Norte');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (349, 108, 'Carirubana');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (350, 108, 'Santa Ana');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (351, 108, 'Urbana Punta Cardón');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (352, 109, 'La Vela de Coro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (353, 109, 'Acurigua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (354, 109, 'Guaibacoa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (355, 109, 'Las Calderas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (356, 109, 'Macoruca');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (357, 110, 'Dabajuro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (358, 111, 'Agua Clara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (359, 111, 'Avaria');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (360, 111, 'Pedregal');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (361, 111, 'Piedra Grande');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (362, 111, 'Purureche');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (363, 112, 'Adaure');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (364, 112, 'Adícora');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (365, 112, 'Baraived');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (366, 112, 'Buena Vista');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (367, 112, 'Jadacaquiva');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (368, 112, 'El Vínculo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (369, 112, 'El Hato');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (370, 112, 'Moruy');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (371, 112, 'Pueblo Nuevo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (372, 113, 'Agua Larga');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (373, 113, 'El Paují');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (374, 113, 'Independencia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (375, 113, 'Mapararí');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (376, 114, 'Agua Linda');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (377, 114, 'Araurima');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (378, 114, 'Jacura');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (379, 115, 'Tucacas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (380, 115, 'Boca de Aroa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (381, 116, 'Los Taques');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (382, 116, 'Judibana');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (383, 117, 'Mene de Mauroa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (384, 117, 'San Félix');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (385, 117, 'Casigua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (386, 118, 'Guzmán Guillermo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (387, 118, 'Mitare');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (388, 118, 'Río Seco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (389, 118, 'Sabaneta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (390, 118, 'San Antonio');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (391, 118, 'San Gabriel');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (392, 118, 'Santa Ana');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (393, 119, 'Boca del Tocuyo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (394, 119, 'Chichiriviche');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (395, 119, 'Tocuyo de la Costa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (396, 120, 'Palmasola');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (397, 121, 'Cabure');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (398, 121, 'Colina');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (399, 121, 'Curimagua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (400, 122, 'San José de la Costa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (401, 122, 'Píritu');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (402, 123, 'San Francisco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (403, 124, 'Sucre');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (404, 124, 'Pecaya');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (405, 125, 'Tocópero');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (406, 126, 'El Charal');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (407, 126, 'Las Vegas del Tuy');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (408, 126, 'Santa Cruz de Bucaral');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (409, 127, 'Bruzual');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (410, 127, 'Urumaco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (411, 128, 'Puerto Cumarebo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (412, 128, 'La Ciénaga');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (413, 128, 'La Soledad');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (414, 128, 'Pueblo Cumarebo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (415, 128, 'Zazárida');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (416, 113, 'Churuguara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (417, 129, 'Camaguán');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (418, 129, 'Puerto Miranda');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (419, 129, 'Uverito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (420, 130, 'Chaguaramas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (421, 131, 'El Socorro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (422, 132, 'Tucupido');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (423, 132, 'San Rafael de Laya');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (424, 133, 'Altagracia de Orituco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (425, 133, 'San Rafael de Orituco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (426, 133, 'San Francisco Javier de Lezama');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (427, 133, 'Paso Real de Macaira');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (428, 133, 'Carlos Soublette');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (429, 133, 'San Francisco de Macaira');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (430, 133, 'Libertad de Orituco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (431, 134, 'Cantaclaro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (432, 134, 'San Juan de los Morros');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (433, 134, 'Parapara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (434, 135, 'El Sombrero');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (435, 135, 'Sosa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (436, 136, 'Las Mercedes');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (437, 136, 'Cabruta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (438, 136, 'Santa Rita de Manapire');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (439, 137, 'Valle de la Pascua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (440, 137, 'Espino');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (441, 138, 'San José de Unare');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (442, 138, 'Zaraza');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (443, 139, 'San José de Tiznados');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (444, 139, 'San Francisco de Tiznados');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (445, 139, 'San Lorenzo de Tiznados');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (446, 139, 'Ortiz');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (447, 140, 'Guayabal');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (448, 140, 'Cazorla');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (449, 141, 'San José de Guaribe');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (450, 141, 'Uveral');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (451, 142, 'Santa María de Ipire');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (452, 142, 'Altamira');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (453, 143, 'El Calvario');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (454, 143, 'El Rastro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (455, 143, 'Guardatinajas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (456, 143, 'Capital Urbana Calabozo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (457, 144, 'Quebrada Honda de Guache');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (458, 144, 'Pío Tamayo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (459, 144, 'Yacambú');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (460, 145, 'Fréitez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (461, 145, 'José María Blanco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (462, 146, 'Catedral');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (463, 146, 'Concepción');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (464, 146, 'El Cují');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (465, 146, 'Juan de Villegas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (466, 146, 'Santa Rosa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (467, 146, 'Tamaca');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (468, 146, 'Unión');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (469, 146, 'Aguedo Felipe Alvarado');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (470, 146, 'Buena Vista');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (471, 146, 'Juárez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (472, 147, 'Juan Bautista Rodríguez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (473, 147, 'Cuara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (474, 147, 'Diego de Lozada');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (475, 147, 'Paraíso de San José');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (476, 147, 'San Miguel');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (477, 147, 'Tintorero');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (478, 147, 'José Bernardo Dorante');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (479, 147, 'Coronel Mariano Peraza ');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (480, 148, 'Bolívar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (481, 148, 'Anzoátegui');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (482, 148, 'Guarico');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (483, 148, 'Hilario Luna y Luna');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (484, 148, 'Humocaro Alto');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (485, 148, 'Humocaro Bajo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (486, 148, 'La Candelaria');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (487, 148, 'Morán');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (488, 149, 'Cabudare');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (489, 149, 'José Gregorio Bastidas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (490, 149, 'Agua Viva');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (491, 150, 'Sarare');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (492, 150, 'Buría');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (493, 150, 'Gustavo Vegas León');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (494, 151, 'Trinidad Samuel');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (495, 151, 'Antonio Díaz');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (496, 151, 'Camacaro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (497, 151, 'Castañeda');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (498, 151, 'Cecilio Zubillaga');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (499, 151, 'Chiquinquirá');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (500, 151, 'El Blanco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (501, 151, 'Espinoza de los Monteros');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (502, 151, 'Lara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (503, 151, 'Las Mercedes');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (504, 151, 'Manuel Morillo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (505, 151, 'Montaña Verde');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (506, 151, 'Montes de Oca');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (507, 151, 'Torres');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (508, 151, 'Heriberto Arroyo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (509, 151, 'Reyes Vargas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (510, 151, 'Altagracia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (511, 152, 'Siquisique');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (512, 152, 'Moroturo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (513, 152, 'San Miguel');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (514, 152, 'Xaguas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (515, 179, 'Presidente Betancourt');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (516, 179, 'Presidente Páez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (517, 179, 'Presidente Rómulo Gallegos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (518, 179, 'Gabriel Picón González');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (519, 179, 'Héctor Amable Mora');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (520, 179, 'José Nucete Sardi');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (521, 179, 'Pulido Méndez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (522, 180, 'La Azulita');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (523, 181, 'Santa Cruz de Mora');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (524, 181, 'Mesa Bolívar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (525, 181, 'Mesa de Las Palmas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (526, 182, 'Aricagua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (527, 182, 'San Antonio');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (528, 183, 'Canagua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (529, 183, 'Capurí');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (530, 183, 'Chacantá');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (531, 183, 'El Molino');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (532, 183, 'Guaimaral');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (533, 183, 'Mucutuy');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (534, 183, 'Mucuchachí');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (535, 184, 'Fernández Peña');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (536, 184, 'Matriz');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (537, 184, 'Montalbán');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (538, 184, 'Acequias');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (539, 184, 'Jají');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (540, 184, 'La Mesa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (541, 184, 'San José del Sur');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (542, 185, 'Tucaní');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (543, 185, 'Florencio Ramírez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (544, 186, 'Santo Domingo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (545, 186, 'Las Piedras');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (546, 187, 'Guaraque');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (547, 187, 'Mesa de Quintero');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (548, 187, 'Río Negro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (549, 188, 'Arapuey');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (550, 188, 'Palmira');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (551, 189, 'San Cristóbal de Torondoy');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (552, 189, 'Torondoy');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (553, 190, 'Antonio Spinetti Dini');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (554, 190, 'Arias');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (555, 190, 'Caracciolo Parra Pérez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (556, 190, 'Domingo Peña');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (557, 190, 'El Llano');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (558, 190, 'Gonzalo Picón Febres');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (559, 190, 'Jacinto Plaza');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (560, 190, 'Juan Rodríguez Suárez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (561, 190, 'Lasso de la Vega');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (562, 190, 'Mariano Picón Salas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (563, 190, 'Milla');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (564, 190, 'Osuna Rodríguez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (565, 190, 'Sagrario');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (566, 190, 'El Morro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (567, 190, 'Los Nevados');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (568, 191, 'Andrés Eloy Blanco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (569, 191, 'La Venta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (570, 191, 'Piñango');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (571, 191, 'Timotes');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (572, 192, 'Eloy Paredes');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (573, 192, 'San Rafael de Alcázar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (574, 192, 'Santa Elena de Arenales');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (575, 193, 'Santa María de Caparo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (576, 194, 'Pueblo Llano');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (577, 195, 'Cacute');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (578, 195, 'La Toma');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (579, 195, 'Mucuchíes');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (580, 195, 'Mucurubá');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (581, 195, 'San Rafael');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (582, 196, 'Gerónimo Maldonado');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (583, 196, 'Bailadores');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (584, 197, 'Tabay');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (585, 198, 'Chiguará');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (586, 198, 'Estánquez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (587, 198, 'Lagunillas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (588, 198, 'La Trampa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (589, 198, 'Pueblo Nuevo del Sur');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (590, 198, 'San Juan');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (591, 199, 'El Amparo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (592, 199, 'El Llano');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (593, 199, 'San Francisco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (594, 199, 'Tovar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (595, 200, 'Independencia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (596, 200, 'María de la Concepción Palacios Blanco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (597, 200, 'Nueva Bolivia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (598, 200, 'Santa Apolonia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (599, 201, 'Caño El Tigre');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (600, 201, 'Zea');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (601, 223, 'Aragüita');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (602, 223, 'Arévalo González');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (603, 223, 'Capaya');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (604, 223, 'Caucagua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (605, 223, 'Panaquire');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (606, 223, 'Ribas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (607, 223, 'El Café');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (608, 223, 'Marizapa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (609, 224, 'Cumbo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (610, 224, 'San José de Barlovento');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (611, 225, 'El Cafetal');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (612, 225, 'Las Minas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (613, 225, 'Nuestra Señora del Rosario');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (614, 226, 'Higuerote');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (615, 226, 'Curiepe');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (616, 226, 'Tacarigua de Brión');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (617, 227, 'Mamporal');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (618, 228, 'Carrizal');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (619, 229, 'Chacao');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (620, 230, 'Charallave');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (621, 230, 'Las Brisas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (622, 231, 'El Hatillo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (623, 232, 'Altagracia de la Montaña');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (624, 232, 'Cecilio Acosta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (625, 232, 'Los Teques');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (626, 232, 'El Jarillo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (627, 232, 'San Pedro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (628, 232, 'Tácata');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (629, 232, 'Paracotos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (630, 233, 'Cartanal');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (631, 233, 'Santa Teresa del Tuy');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (632, 234, 'La Democracia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (633, 234, 'Ocumare del Tuy');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (634, 234, 'Santa Bárbara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (635, 235, 'San Antonio de los Altos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (636, 236, 'Río Chico');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (637, 236, 'El Guapo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (638, 236, 'Tacarigua de la Laguna');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (639, 236, 'Paparo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (640, 236, 'San Fernando del Guapo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (641, 237, 'Santa Lucía del Tuy');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (642, 238, 'Cúpira');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (643, 238, 'Machurucuto');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (644, 239, 'Guarenas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (645, 240, 'San Antonio de Yare');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (646, 240, 'San Francisco de Yare');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (647, 241, 'Leoncio Martínez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (648, 241, 'Petare');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (649, 241, 'Caucagüita');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (650, 241, 'Filas de Mariche');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (651, 241, 'La Dolorita');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (652, 242, 'Cúa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (653, 242, 'Nueva Cúa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (654, 243, 'Guatire');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (655, 243, 'Bolívar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (656, 258, 'San Antonio de Maturín');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (657, 258, 'San Francisco de Maturín');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (658, 259, 'Aguasay');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (659, 260, 'Caripito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (660, 261, 'El Guácharo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (661, 261, 'La Guanota');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (662, 261, 'Sabana de Piedra');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (663, 261, 'San Agustín');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (664, 261, 'Teresen');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (665, 261, 'Caripe');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (666, 262, 'Areo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (667, 262, 'Capital Cedeño');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (668, 262, 'San Félix de Cantalicio');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (669, 262, 'Viento Fresco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (670, 263, 'El Tejero');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (671, 263, 'Punta de Mata');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (672, 264, 'Chaguaramas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (673, 264, 'Las Alhuacas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (674, 264, 'Tabasca');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (675, 264, 'Temblador');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (676, 265, 'Alto de los Godos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (677, 265, 'Boquerón');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (678, 265, 'Las Cocuizas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (679, 265, 'La Cruz');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (680, 265, 'San Simón');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (681, 265, 'El Corozo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (682, 265, 'El Furrial');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (683, 265, 'Jusepín');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (684, 265, 'La Pica');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (685, 265, 'San Vicente');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (686, 266, 'Aparicio');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (687, 266, 'Aragua de Maturín');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (688, 266, 'Chaguamal');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (689, 266, 'El Pinto');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (690, 266, 'Guanaguana');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (691, 266, 'La Toscana');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (692, 266, 'Taguaya');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (693, 267, 'Cachipo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (694, 267, 'Quiriquire');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (695, 268, 'Santa Bárbara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (696, 269, 'Barrancas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (697, 269, 'Los Barrancos de Fajardo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (698, 270, 'Uracoa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (699, 271, 'Antolín del Campo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (700, 272, 'Arismendi');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (701, 273, 'García');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (702, 273, 'Francisco Fajardo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (703, 274, 'Bolívar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (704, 274, 'Guevara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (705, 274, 'Matasiete');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (706, 274, 'Santa Ana');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (707, 274, 'Sucre');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (708, 275, 'Aguirre');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (709, 275, 'Maneiro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (710, 276, 'Adrián');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (711, 276, 'Juan Griego');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (712, 276, 'Yaguaraparo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (713, 277, 'Porlamar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (714, 278, 'San Francisco de Macanao');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (715, 278, 'Boca de Río');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (716, 279, 'Tubores');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (717, 279, 'Los Baleales');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (718, 280, 'Vicente Fuentes');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (719, 280, 'Villalba');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (720, 281, 'San Juan Bautista');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (721, 281, 'Zabala');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (722, 283, 'Capital Araure');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (723, 283, 'Río Acarigua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (724, 284, 'Capital Esteller');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (725, 284, 'Uveral');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (726, 285, 'Guanare');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (727, 285, 'Córdoba');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (728, 285, 'San José de la Montaña');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (729, 285, 'San Juan de Guanaguanare');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (730, 285, 'Virgen de la Coromoto');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (731, 286, 'Guanarito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (732, 286, 'Trinidad de la Capilla');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (733, 286, 'Divina Pastora');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (734, 287, 'Monseñor José Vicente de Unda');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (735, 287, 'Peña Blanca');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (736, 288, 'Capital Ospino');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (737, 288, 'Aparición');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (738, 288, 'La Estación');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (739, 289, 'Páez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (740, 289, 'Payara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (741, 289, 'Pimpinela');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (742, 289, 'Ramón Peraza');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (743, 290, 'Papelón');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (744, 290, 'Caño Delgadito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (745, 291, 'San Genaro de Boconoito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (746, 291, 'Antolín Tovar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (747, 292, 'San Rafael de Onoto');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (748, 292, 'Santa Fe');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (749, 292, 'Thermo Morles');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (750, 293, 'Santa Rosalía');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (751, 293, 'Florida');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (752, 294, 'Sucre');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (753, 294, 'Concepción');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (754, 294, 'San Rafael de Palo Alzado');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (755, 294, 'Uvencio Antonio Velásquez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (756, 294, 'San José de Saguaz');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (757, 294, 'Villa Rosa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (758, 295, 'Turén');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (759, 295, 'Canelones');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (760, 295, 'Santa Cruz');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (761, 295, 'San Isidro Labrador');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (762, 296, 'Mariño');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (763, 296, 'Rómulo Gallegos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (764, 297, 'San José de Aerocuar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (765, 297, 'Tavera Acosta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (766, 298, 'Río Caribe');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (767, 298, 'Antonio José de Sucre');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (768, 298, 'El Morro de Puerto Santo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (769, 298, 'Puerto Santo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (770, 298, 'San Juan de las Galdonas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (771, 299, 'El Pilar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (772, 299, 'El Rincón');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (773, 299, 'General Francisco Antonio Váquez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (774, 299, 'Guaraúnos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (775, 299, 'Tunapuicito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (776, 299, 'Unión');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (777, 300, 'Santa Catalina');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (778, 300, 'Santa Rosa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (779, 300, 'Santa Teresa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (780, 300, 'Bolívar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (781, 300, 'Maracapana');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (782, 302, 'Libertad');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (783, 302, 'El Paujil');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (784, 302, 'Yaguaraparo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (785, 303, 'Cruz Salmerón Acosta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (786, 303, 'Chacopata');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (787, 303, 'Manicuare');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (788, 304, 'Tunapuy');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (789, 304, 'Campo Elías');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (790, 305, 'Irapa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (791, 305, 'Campo Claro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (792, 305, 'Maraval');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (793, 305, 'San Antonio de Irapa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (794, 305, 'Soro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (795, 306, 'Mejía');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (796, 307, 'Cumanacoa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (797, 307, 'Arenas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (798, 307, 'Aricagua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (799, 307, 'Cogollar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (800, 307, 'San Fernando');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (801, 307, 'San Lorenzo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (802, 308, 'Villa Frontado (Muelle de Cariaco)');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (803, 308, 'Catuaro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (804, 308, 'Rendón');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (805, 308, 'San Cruz');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (806, 308, 'Santa María');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (807, 309, 'Altagracia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (808, 309, 'Santa Inés');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (809, 309, 'Valentín Valiente');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (810, 309, 'Ayacucho');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (811, 309, 'San Juan');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (812, 309, 'Raúl Leoni');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (813, 309, 'Gran Mariscal');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (814, 310, 'Cristóbal Colón');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (815, 310, 'Bideau');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (816, 310, 'Punta de Piedras');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (817, 310, 'Güiria');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (818, 341, 'Andrés Bello');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (819, 342, 'Antonio Rómulo Costa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (820, 343, 'Ayacucho');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (821, 343, 'Rivas Berti');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (822, 343, 'San Pedro del Río');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (823, 344, 'Bolívar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (824, 344, 'Palotal');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (825, 344, 'General Juan Vicente Gómez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (826, 344, 'Isaías Medina Angarita');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (827, 345, 'Cárdenas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (828, 345, 'Amenodoro Ángel Lamus');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (829, 345, 'La Florida');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (830, 346, 'Córdoba');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (831, 347, 'Fernández Feo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (832, 347, 'Alberto Adriani');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (833, 347, 'Santo Domingo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (834, 348, 'Francisco de Miranda');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (835, 349, 'García de Hevia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (836, 349, 'Boca de Grita');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (837, 349, 'José Antonio Páez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (838, 350, 'Guásimos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (839, 351, 'Independencia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (840, 351, 'Juan Germán Roscio');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (841, 351, 'Román Cárdenas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (842, 352, 'Jáuregui');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (843, 352, 'Emilio Constantino Guerrero');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (844, 352, 'Monseñor Miguel Antonio Salas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (845, 353, 'José María Vargas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (846, 354, 'Junín');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (847, 354, 'La Petrólea');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (848, 354, 'Quinimarí');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (849, 354, 'Bramón');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (850, 355, 'Libertad');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (851, 355, 'Cipriano Castro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (852, 355, 'Manuel Felipe Rugeles');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (853, 356, 'Libertador');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (854, 356, 'Doradas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (855, 356, 'Emeterio Ochoa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (856, 356, 'San Joaquín de Navay');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (857, 357, 'Lobatera');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (858, 357, 'Constitución');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (859, 358, 'Michelena');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (860, 359, 'Panamericano');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (861, 359, 'La Palmita');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (862, 360, 'Pedro María Ureña');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (863, 360, 'Nueva Arcadia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (864, 361, 'Delicias');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (865, 361, 'Pecaya');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (866, 362, 'Samuel Darío Maldonado');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (867, 362, 'Boconó');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (868, 362, 'Hernández');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (869, 363, 'La Concordia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (870, 363, 'San Juan Bautista');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (871, 363, 'Pedro María Morantes');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (872, 363, 'San Sebastián');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (873, 363, 'Dr. Francisco Romero Lobo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (874, 364, 'Seboruco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (875, 365, 'Simón Rodríguez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (876, 366, 'Sucre');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (877, 366, 'Eleazar López Contreras');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (878, 366, 'San Pablo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (879, 367, 'Torbes');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (880, 368, 'Uribante');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (881, 368, 'Cárdenas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (882, 368, 'Juan Pablo Peñalosa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (883, 368, 'Potosí');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (884, 369, 'San Judas Tadeo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (885, 370, 'Araguaney');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (886, 370, 'El Jaguito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (887, 370, 'La Esperanza');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (888, 370, 'Santa Isabel');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (889, 371, 'Boconó');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (890, 371, 'El Carmen');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (891, 371, 'Mosquey');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (892, 371, 'Ayacucho');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (893, 371, 'Burbusay');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (894, 371, 'General Ribas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (895, 371, 'Guaramacal');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (896, 371, 'Vega de Guaramacal');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (897, 371, 'Monseñor Jáuregui');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (898, 371, 'Rafael Rangel');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (899, 371, 'San Miguel');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (900, 371, 'San José');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (901, 372, 'Sabana Grande');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (902, 372, 'Cheregüé');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (903, 372, 'Granados');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (904, 373, 'Arnoldo Gabaldón');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (905, 373, 'Bolivia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (906, 373, 'Carrillo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (907, 373, 'Cegarra');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (908, 373, 'Chejendé');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (909, 373, 'Manuel Salvador Ulloa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (910, 373, 'San José');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (911, 374, 'Carache');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (912, 374, 'La Concepción');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (913, 374, 'Cuicas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (914, 374, 'Panamericana');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (915, 374, 'Santa Cruz');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (916, 375, 'Escuque');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (917, 375, 'La Unión');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (918, 375, 'Santa Rita');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (919, 375, 'Sabana Libre');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (920, 376, 'El Socorro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (921, 376, 'Los Caprichos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (922, 376, 'Antonio José de Sucre');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (923, 377, 'Campo Elías');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (924, 377, 'Arnoldo Gabaldón');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (925, 378, 'Santa Apolonia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (926, 378, 'El Progreso');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (927, 378, 'La Ceiba');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (928, 378, 'Tres de Febrero');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (929, 379, 'El Dividive');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (930, 379, 'Agua Santa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (931, 379, 'Agua Caliente');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (932, 379, 'El Cenizo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (933, 379, 'Valerita');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (934, 380, 'Monte Carmelo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (935, 380, 'Buena Vista');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (936, 380, 'Santa María del Horcón');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (937, 381, 'Motatán');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (938, 381, 'El Baño');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (939, 381, 'Jalisco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (940, 382, 'Pampán');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (941, 382, 'Flor de Patria');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (942, 382, 'La Paz');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (943, 382, 'Santa Ana');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (944, 383, 'Pampanito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (945, 383, 'La Concepción');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (946, 383, 'Pampanito II');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (947, 384, 'Betijoque');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (948, 384, 'José Gregorio Hernández');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (949, 384, 'La Pueblita');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (950, 384, 'Los Cedros');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (951, 385, 'Carvajal');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (952, 385, 'Campo Alegre');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (953, 385, 'Antonio Nicolás Briceño');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (954, 385, 'José Leonardo Suárez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (955, 386, 'Sabana de Mendoza');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (956, 386, 'Junín');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (957, 386, 'Valmore Rodríguez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (958, 386, 'El Paraíso');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (959, 387, 'Andrés Linares');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (960, 387, 'Chiquinquirá');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (961, 387, 'Cristóbal Mendoza');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (962, 387, 'Cruz Carrillo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (963, 387, 'Matriz');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (964, 387, 'Monseñor Carrillo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (965, 387, 'Tres Esquinas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (966, 388, 'Cabimbú');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (967, 388, 'Jajó');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (968, 388, 'La Mesa de Esnujaque');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (969, 388, 'Santiago');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (970, 388, 'Tuñame');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (971, 388, 'La Quebrada');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (972, 389, 'Juan Ignacio Montilla');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (973, 389, 'La Beatriz');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (974, 389, 'La Puerta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (975, 389, 'Mendoza del Valle de Momboy');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (976, 389, 'Mercedes Díaz');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (977, 389, 'San Luis');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (978, 390, 'Caraballeda');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (979, 390, 'Carayaca');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (980, 390, 'Carlos Soublette');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (981, 390, 'Caruao Chuspa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (982, 390, 'Catia La Mar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (983, 390, 'El Junko');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (984, 390, 'La Guaira');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (985, 390, 'Macuto');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (986, 390, 'Maiquetía');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (987, 390, 'Naiguatá');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (988, 390, 'Urimare');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (989, 391, 'Arístides Bastidas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (990, 392, 'Bolívar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (991, 407, 'Chivacoa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (992, 407, 'Campo Elías');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (993, 408, 'Cocorote');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (994, 409, 'Independencia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (995, 410, 'José Antonio Páez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (996, 411, 'La Trinidad');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (997, 412, 'Manuel Monge');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (998, 413, 'Salóm');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (999, 413, 'Temerla');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1000, 413, 'Nirgua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1001, 414, 'San Andrés');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1002, 414, 'Yaritagua');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1003, 415, 'San Javier');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1004, 415, 'Albarico');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1005, 415, 'San Felipe');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1006, 416, 'Sucre');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1007, 417, 'Urachiche');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1008, 418, 'El Guayabo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1009, 418, 'Farriar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1010, 441, 'Isla de Toas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1011, 441, 'Monagas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1012, 442, 'San Timoteo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1013, 442, 'General Urdaneta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1014, 442, 'Libertador');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1015, 442, 'Marcelino Briceño');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1016, 442, 'Pueblo Nuevo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1017, 442, 'Manuel Guanipa Matos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1018, 443, 'Ambrosio');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1019, 443, 'Carmen Herrera');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1020, 443, 'La Rosa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1021, 443, 'Germán Ríos Linares');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1022, 443, 'San Benito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1023, 443, 'Rómulo Betancourt');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1024, 443, 'Jorge Hernández');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1025, 443, 'Punta Gorda');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1026, 443, 'Arístides Calvani');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1027, 444, 'Encontrados');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1028, 444, 'Udón Pérez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1029, 445, 'Moralito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1030, 445, 'San Carlos del Zulia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1031, 445, 'Santa Cruz del Zulia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1032, 445, 'Santa Bárbara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1033, 445, 'Urribarrí');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1034, 446, 'Carlos Quevedo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1035, 446, 'Francisco Javier Pulgar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1036, 446, 'Simón Rodríguez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1037, 446, 'Guamo-Gavilanes');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1038, 448, 'La Concepción');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1039, 448, 'San José');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1040, 448, 'Mariano Parra León');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1041, 448, 'José Ramón Yépez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1042, 449, 'Jesús María Semprún');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1043, 449, 'Barí');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1044, 450, 'Concepción');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1045, 450, 'Andrés Bello');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1046, 450, 'Chiquinquirá');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1047, 450, 'El Carmelo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1048, 450, 'Potreritos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1049, 451, 'Libertad');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1050, 451, 'Alonso de Ojeda');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1051, 451, 'Venezuela');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1052, 451, 'Eleazar López Contreras');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1053, 451, 'Campo Lara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1054, 452, 'Bartolomé de las Casas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1055, 452, 'Libertad');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1056, 452, 'Río Negro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1057, 452, 'San José de Perijá');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1058, 453, 'San Rafael');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1059, 453, 'La Sierrita');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1060, 453, 'Las Parcelas');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1061, 453, 'Luis de Vicente');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1062, 453, 'Monseñor Marcos Sergio Godoy');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1063, 453, 'Ricaurte');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1064, 453, 'Tamare');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1065, 454, 'Antonio Borjas Romero');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1066, 454, 'Bolívar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1067, 454, 'Cacique Mara');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1068, 454, 'Carracciolo Parra Pérez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1069, 454, 'Cecilio Acosta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1070, 454, 'Cristo de Aranza');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1071, 454, 'Coquivacoa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1072, 454, 'Chiquinquirá');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1073, 454, 'Francisco Eugenio Bustamante');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1074, 454, 'Idelfonzo Vásquez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1075, 454, 'Juana de Ávila');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1076, 454, 'Luis Hurtado Higuera');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1077, 454, 'Manuel Dagnino');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1078, 454, 'Olegario Villalobos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1079, 454, 'Raúl Leoni');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1080, 454, 'Santa Lucía');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1081, 454, 'Venancio Pulgar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1082, 454, 'San Isidro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1083, 455, 'Altagracia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1084, 455, 'Faría');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1085, 455, 'Ana María Campos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1086, 455, 'San Antonio');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1087, 455, 'San José');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1088, 456, 'Donaldo García');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1089, 456, 'El Rosario');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1090, 456, 'Sixto Zambrano');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1091, 457, 'San Francisco');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1092, 457, 'El Bajo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1093, 457, 'Domitila Flores');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1094, 457, 'Francisco Ochoa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1095, 457, 'Los Cortijos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1096, 457, 'Marcial Hernández');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1097, 458, 'Santa Rita');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1098, 458, 'El Mene');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1099, 458, 'Pedro Lucas Urribarrí');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1100, 458, 'José Cenobio Urribarrí');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1101, 459, 'Rafael Maria Baralt');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1102, 459, 'Manuel Manrique');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1103, 459, 'Rafael Urdaneta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1104, 460, 'Bobures');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1105, 460, 'Gibraltar');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1106, 460, 'Heras');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1107, 460, 'Monseñor Arturo Álvarez');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1108, 460, 'Rómulo Gallegos');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1109, 460, 'El Batey');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1110, 461, 'Rafael Urdaneta');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1111, 461, 'La Victoria');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1112, 461, 'Raúl Cuenca');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1113, 447, 'Sinamaica');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1114, 447, 'Alta Guajira');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1115, 447, 'Elías Sánchez Rubio');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1116, 447, 'Guajira');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1117, 462, 'Altagracia');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1118, 462, 'Antímano');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1119, 462, 'Caricuao');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1120, 462, 'Catedral');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1121, 462, 'Coche');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1122, 462, 'El Junquito');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1123, 462, 'El Paraíso');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1124, 462, 'El Recreo');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1125, 462, 'El Valle');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1126, 462, 'La Candelaria');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1127, 462, 'La Pastora');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1128, 462, 'La Vega');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1129, 462, 'Macarao');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1130, 462, 'San Agustín');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1131, 462, 'San Bernardino');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1132, 462, 'San José');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1133, 462, 'San Juan');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1134, 462, 'San Pedro');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1135, 462, 'Santa Rosalía');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1136, 462, 'Santa Teresa');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1137, 462, 'Sucre (Catia)');
INSERT INTO public.parroquias (id_parroquia, id_municipio, parroquia) VALUES (1138, 462, '23 de enero');


--
-- TOC entry 3071 (class 0 OID 16407)
-- Dependencies: 207
-- Data for Name: personas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.personas (doc_identidad, nombres, apellidos, fecha_nacimiento, id_nacionalidad, id_genero) VALUES ('13453984', 'Carlos Luis', 'Esparza Guerra', '1980-07-10', 1, 1);
INSERT INTO public.personas (doc_identidad, nombres, apellidos, fecha_nacimiento, id_nacionalidad, id_genero) VALUES ('16273686', 'Luis', 'Perez', '2020-06-06', 1, 1);
INSERT INTO public.personas (doc_identidad, nombres, apellidos, fecha_nacimiento, id_nacionalidad, id_genero) VALUES ('1902930', 'Karla Maria', 'Verastegui Villaverde', '1990-02-20', 1, 2);
INSERT INTO public.personas (doc_identidad, nombres, apellidos, fecha_nacimiento, id_nacionalidad, id_genero) VALUES ('20293099', 'Carlos', 'Arteaga', '2020-06-05', 1, 1);
INSERT INTO public.personas (doc_identidad, nombres, apellidos, fecha_nacimiento, id_nacionalidad, id_genero) VALUES ('18293837', 'Carlos', 'Perez Hernandez', '1982-09-22', 1, 1);
INSERT INTO public.personas (doc_identidad, nombres, apellidos, fecha_nacimiento, id_nacionalidad, id_genero) VALUES ('28117206', 'Newman Louis', 'Rodriguez Robles', '1999-06-26', 1, 1);
INSERT INTO public.personas (doc_identidad, nombres, apellidos, fecha_nacimiento, id_nacionalidad, id_genero) VALUES ('19283938', 'Maria Angela', 'Perez Ribasa', '2020-07-03', 1, 2);


--
-- TOC entry 3072 (class 0 OID 16410)
-- Dependencies: 208
-- Data for Name: plantilla_informe; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3066 (class 0 OID 16385)
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


--
-- TOC entry 3073 (class 0 OID 16413)
-- Dependencies: 209
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuarios (alias, id_nacionalidad, doc_identidad, id_nivel_permiso, id_estado, pass_encrypt, email, telefono) VALUES ('calito_22', 1, '13453984', 2, 1, 'Wk8vdWFYT1YwVDV0WGhLVGZ1aVJtZz09', 'calito_21@gmail.com', '04140363234');
INSERT INTO public.usuarios (alias, id_nacionalidad, doc_identidad, id_nivel_permiso, id_estado, pass_encrypt, email, telefono) VALUES ('karla_villa', 1, '1902930', 3, 0, 'MGF5VG42RWVaMGorL01Cb21KMzlSZz09', 'karla_villa112@gmail.com', '02399384938');
INSERT INTO public.usuarios (alias, id_nacionalidad, doc_identidad, id_nivel_permiso, id_estado, pass_encrypt, email, telefono) VALUES ('luisespar_12', 1, '13453984', 3, 0, 'Wk8vdWFYT1YwVDV0WGhLVGZ1aVJtZz09', 'luisespar12@gmail.com', '04120394034');
INSERT INTO public.usuarios (alias, id_nacionalidad, doc_identidad, id_nivel_permiso, id_estado, pass_encrypt, email, telefono) VALUES ('hernandez21', 1, '18293837', 3, 0, 'Wk8vdWFYT1YwVDV0WGhLVGZ1aVJtZz09', 'hernandez21@gmail.com', '04120329029');
INSERT INTO public.usuarios (alias, id_nacionalidad, doc_identidad, id_nivel_permiso, id_estado, pass_encrypt, email, telefono) VALUES ('newman206', 1, '28117206', 1, 1, 'Wk8vdWFYT1YwVDV0WGhLVGZ1aVJtZz09', 'newman@gmail.com', '04120293034');
INSERT INTO public.usuarios (alias, id_nacionalidad, doc_identidad, id_nivel_permiso, id_estado, pass_encrypt, email, telefono) VALUES ('mariaangel_22', 1, '19283938', 2, 1, 'Wk8vdWFYT1YwVDV0WGhLVGZ1aVJtZz09', 'Mariaangel_22@gmail.com', '04122122212');


--
-- TOC entry 3074 (class 0 OID 16416)
-- Dependencies: 210
-- Data for Name: usuarios_estados; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuarios_estados (id_estado, descripcion_estado) VALUES (0, 'Inactivo');
INSERT INTO public.usuarios_estados (id_estado, descripcion_estado) VALUES (1, 'Activo');
INSERT INTO public.usuarios_estados (id_estado, descripcion_estado) VALUES (2, 'Reiniciado');


--
-- TOC entry 3075 (class 0 OID 16419)
-- Dependencies: 211
-- Data for Name: usuarios_niveles; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuarios_niveles (id_nivel_permiso, descripcion_nivel_permiso) VALUES (1, 'Administrador');
INSERT INTO public.usuarios_niveles (id_nivel_permiso, descripcion_nivel_permiso) VALUES (2, 'Normal');
INSERT INTO public.usuarios_niveles (id_nivel_permiso, descripcion_nivel_permiso) VALUES (3, 'Invitado');


--
-- TOC entry 3076 (class 0 OID 16422)
-- Dependencies: 212
-- Data for Name: usuarios_preguntas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuarios_preguntas (usuario_alias, id_pregunta, respuesta) VALUES ('calito_22', 1, 'aaa');
INSERT INTO public.usuarios_preguntas (usuario_alias, id_pregunta, respuesta) VALUES ('calito_22', 2, 'bGMvR2pqWWpPQ29sV1dEUWZtcExmdz09');
INSERT INTO public.usuarios_preguntas (usuario_alias, id_pregunta, respuesta) VALUES ('karla_villa', 1, 'eDJORGNVUURPK2xnS0JnY0xxcFVEdz09');
INSERT INTO public.usuarios_preguntas (usuario_alias, id_pregunta, respuesta) VALUES ('karla_villa', 2, 'QmUrb1Q4OHBHbVhoUkN2QnZNaEIxdz09');
INSERT INTO public.usuarios_preguntas (usuario_alias, id_pregunta, respuesta) VALUES ('mariaangel_22', 1, 'dEpha1ZrOFc4OUFvRU5lTWtVRG1kZz09');
INSERT INTO public.usuarios_preguntas (usuario_alias, id_pregunta, respuesta) VALUES ('mariaangel_22', 2, 'bGMvR2pqWWpPQ29sV1dEUWZtcExmdz09');
INSERT INTO public.usuarios_preguntas (usuario_alias, id_pregunta, respuesta) VALUES ('newman206', 1, 'dEpha1ZrOFc4OUFvRU5lTWtVRG1kZz09');
INSERT INTO public.usuarios_preguntas (usuario_alias, id_pregunta, respuesta) VALUES ('newman206', 2, 'bGMvR2pqWWpPQ29sV1dEUWZtcExmdz09');
INSERT INTO public.usuarios_preguntas (usuario_alias, id_pregunta, respuesta) VALUES ('hernandez21', 1, 'SXNQcWplMTRqdmx0ZEVrMjE2UTRxUT09');
INSERT INTO public.usuarios_preguntas (usuario_alias, id_pregunta, respuesta) VALUES ('hernandez21', 2, 'bGMvR2pqWWpPQ29sV1dEUWZtcExmdz09');


--
-- TOC entry 3077 (class 0 OID 16425)
-- Dependencies: 213
-- Data for Name: usuarios_preguntas_disponibles; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuarios_preguntas_disponibles (id_pregunta, descripcion) VALUES (1, '¿Cual fue el nombre de tu primera mascota?');
INSERT INTO public.usuarios_preguntas_disponibles (id_pregunta, descripcion) VALUES (2, '¿Cual es el nombre de tu artista favorita?');


--
-- TOC entry 3088 (class 0 OID 0)
-- Dependencies: 214
-- Name: bitacora_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.bitacora_seq', 23, true);


--
-- TOC entry 3089 (class 0 OID 0)
-- Dependencies: 215
-- Name: casos_epidemiologicos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.casos_epidemiologicos_seq', 1, false);


--
-- TOC entry 3090 (class 0 OID 0)
-- Dependencies: 216
-- Name: parroquias_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.parroquias_seq', 1, false);


--
-- TOC entry 2901 (class 2606 OID 16430)
-- Name: usuario_bitacora bitacora_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_bitacora
    ADD CONSTRAINT bitacora_pkey PRIMARY KEY (id_bitacora);


--
-- TOC entry 2903 (class 2606 OID 16439)
-- Name: casos_epidemiologicos casosEpidemiologicos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.casos_epidemiologicos
    ADD CONSTRAINT "casosEpidemiologicos_pkey" PRIMARY KEY (id_caso_epidemiologico);


--
-- TOC entry 2927 (class 2606 OID 16668)
-- Name: data_cie10 data_cie10_consecutivo_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.data_cie10
    ADD CONSTRAINT data_cie10_consecutivo_key UNIQUE (consecutivo);


--
-- TOC entry 2929 (class 2606 OID 16666)
-- Name: data_cie10 data_cie10_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.data_cie10
    ADD CONSTRAINT data_cie10_pkey PRIMARY KEY (catalog_key);


--
-- TOC entry 2905 (class 2606 OID 16536)
-- Name: generos generos_idGenero_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.generos
    ADD CONSTRAINT "generos_idGenero_key" UNIQUE (id_genero);


--
-- TOC entry 2907 (class 2606 OID 16543)
-- Name: generos generos_idGenero_key1; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.generos
    ADD CONSTRAINT "generos_idGenero_key1" UNIQUE (id_genero);


--
-- TOC entry 2909 (class 2606 OID 16550)
-- Name: generos generos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.generos
    ADD CONSTRAINT generos_pkey PRIMARY KEY (id_genero);


--
-- TOC entry 2911 (class 2606 OID 16447)
-- Name: nacionalidades nacionalidades_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nacionalidades
    ADD CONSTRAINT nacionalidades_pkey PRIMARY KEY (id_nacionalidad);


--
-- TOC entry 2913 (class 2606 OID 16449)
-- Name: parroquias parroquias_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.parroquias
    ADD CONSTRAINT parroquias_pkey PRIMARY KEY (id_parroquia);


--
-- TOC entry 2915 (class 2606 OID 16451)
-- Name: personas personas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas
    ADD CONSTRAINT personas_pkey PRIMARY KEY (doc_identidad);


--
-- TOC entry 2919 (class 2606 OID 16453)
-- Name: usuarios_estados usuariosEstados_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios_estados
    ADD CONSTRAINT "usuariosEstados_pkey" PRIMARY KEY (id_estado);


--
-- TOC entry 2921 (class 2606 OID 16455)
-- Name: usuarios_niveles usuariosNiveles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios_niveles
    ADD CONSTRAINT "usuariosNiveles_pkey" PRIMARY KEY (id_nivel_permiso);


--
-- TOC entry 2925 (class 2606 OID 16459)
-- Name: usuarios_preguntas_disponibles usuariosPreguntasDisponibles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios_preguntas_disponibles
    ADD CONSTRAINT "usuariosPreguntasDisponibles_pkey" PRIMARY KEY (id_pregunta);


--
-- TOC entry 2923 (class 2606 OID 16457)
-- Name: usuarios_preguntas usuariosPreguntas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios_preguntas
    ADD CONSTRAINT "usuariosPreguntas_pkey" PRIMARY KEY (usuario_alias, id_pregunta);


--
-- TOC entry 2917 (class 2606 OID 16484)
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (alias);


--
-- TOC entry 2930 (class 2606 OID 16490)
-- Name: usuario_bitacora bitacora_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_bitacora
    ADD CONSTRAINT bitacora_ibfk_1 FOREIGN KEY (usuario_alias) REFERENCES public.usuarios(alias) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2931 (class 2606 OID 16495)
-- Name: casos_epidemiologicos casosEpidemiologicos_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.casos_epidemiologicos
    ADD CONSTRAINT "casosEpidemiologicos_ibfk_1" FOREIGN KEY (doc_identidad) REFERENCES public.personas(doc_identidad) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2932 (class 2606 OID 16522)
-- Name: casos_epidemiologicos casosEpidemiologicos_ibfk_3; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.casos_epidemiologicos
    ADD CONSTRAINT "casosEpidemiologicos_ibfk_3" FOREIGN KEY (id_parroquia) REFERENCES public.parroquias(id_parroquia) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2933 (class 2606 OID 16669)
-- Name: casos_epidemiologicos casosepidemiologicos_ibfk_2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.casos_epidemiologicos
    ADD CONSTRAINT casosepidemiologicos_ibfk_2 FOREIGN KEY (catalog_key_cie10) REFERENCES public.data_cie10(catalog_key);


--
-- TOC entry 2934 (class 2606 OID 16537)
-- Name: personas personas_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas
    ADD CONSTRAINT personas_ibfk_1 FOREIGN KEY (id_genero) REFERENCES public.generos(id_genero) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2935 (class 2606 OID 16544)
-- Name: personas personas_ibfk_2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas
    ADD CONSTRAINT personas_ibfk_2 FOREIGN KEY (id_nacionalidad) REFERENCES public.nacionalidades(id_nacionalidad) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2936 (class 2606 OID 16551)
-- Name: usuarios usuarios_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_ibfk_1 FOREIGN KEY (id_nivel_permiso) REFERENCES public.usuarios_niveles(id_nivel_permiso) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2937 (class 2606 OID 16556)
-- Name: usuarios usuarios_ibfk_3; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_ibfk_3 FOREIGN KEY (id_estado) REFERENCES public.usuarios_estados(id_estado) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2938 (class 2606 OID 16646)
-- Name: usuarios_preguntas usuariospreguntas_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios_preguntas
    ADD CONSTRAINT usuariospreguntas_ibfk_1 FOREIGN KEY (usuario_alias) REFERENCES public.usuarios(alias) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2939 (class 2606 OID 16651)
-- Name: usuarios_preguntas usuariospreguntas_ibfk_3; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios_preguntas
    ADD CONSTRAINT usuariospreguntas_ibfk_3 FOREIGN KEY (id_pregunta) REFERENCES public.usuarios_preguntas_disponibles(id_pregunta) ON UPDATE CASCADE ON DELETE CASCADE;


-- Completed on 2020-09-18 09:15:05 -04

--
-- PostgreSQL database dump complete
--

