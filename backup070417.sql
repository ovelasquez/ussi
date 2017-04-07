--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.4
-- Dumped by pg_dump version 9.5.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: antecendente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE antecendente (
    id bigint NOT NULL,
    paciente_id bigint,
    alergia boolean NOT NULL,
    asma boolean NOT NULL,
    tbc boolean NOT NULL,
    cardiotopia boolean NOT NULL,
    hipertension boolean NOT NULL,
    varices boolean NOT NULL,
    desnutricion boolean NOT NULL,
    diabetes boolean NOT NULL,
    obesidad boolean NOT NULL,
    gastropatia boolean NOT NULL,
    neurologica character varying(255) NOT NULL,
    enfermedad_renal boolean NOT NULL,
    cancer boolean NOT NULL,
    alcohol boolean NOT NULL,
    drogas boolean NOT NULL,
    sifilis boolean NOT NULL,
    sida boolean NOT NULL,
    artritis boolean NOT NULL,
    otros_padre boolean NOT NULL,
    otros_madre boolean NOT NULL,
    otros_hermanos boolean NOT NULL,
    otros boolean NOT NULL,
    fecha_actualizacion date NOT NULL,
    fecha_registro date NOT NULL
);


ALTER TABLE antecendente OWNER TO postgres;

--
-- Name: antecendente_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE antecendente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE antecendente_id_seq OWNER TO postgres;

--
-- Name: antecendente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE antecendente_id_seq OWNED BY antecendente.id;


--
-- Name: cita; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE cita (
    id bigint NOT NULL,
    especialidad_id bigint,
    consulta_id bigint,
    profesional_id bigint,
    paciente_id bigint,
    fecha date NOT NULL,
    status character varying(255) NOT NULL
);


ALTER TABLE cita OWNER TO postgres;

--
-- Name: cita_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cita_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cita_id_seq OWNER TO postgres;

--
-- Name: cita_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cita_id_seq OWNED BY cita.id;


--
-- Name: configuracion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE configuracion (
    id integer NOT NULL,
    numero_consultas smallint,
    servicio_actualizado date,
    tiempo_espera integer,
    penalizacion integer
);


ALTER TABLE configuracion OWNER TO postgres;

--
-- Name: configuracion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE configuracion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE configuracion_id_seq OWNER TO postgres;

--
-- Name: configuracion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE configuracion_id_seq OWNED BY configuracion.id;


--
-- Name: consulta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE consulta (
    id bigint NOT NULL,
    nombre character varying(255) NOT NULL
);


ALTER TABLE consulta OWNER TO postgres;

--
-- Name: consulta_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE consulta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE consulta_id_seq OWNER TO postgres;

--
-- Name: consulta_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE consulta_id_seq OWNED BY consulta.id;


--
-- Name: direccion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE direccion (
    id bigint NOT NULL,
    parroquia_id bigint,
    tipo character varying(255) NOT NULL,
    sector character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE direccion OWNER TO postgres;

--
-- Name: direccion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE direccion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE direccion_id_seq OWNER TO postgres;

--
-- Name: direccion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE direccion_id_seq OWNED BY direccion.id;


--
-- Name: disponible; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE disponible (
    id bigint NOT NULL,
    profesional_especialidad_id bigint,
    fecha timestamp(0) without time zone NOT NULL,
    consultorio character varying(255) NOT NULL,
    status character varying(255) NOT NULL
);


ALTER TABLE disponible OWNER TO postgres;

--
-- Name: disponible_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE disponible_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE disponible_id_seq OWNER TO postgres;

--
-- Name: disponible_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE disponible_id_seq OWNED BY disponible.id;


--
-- Name: especialidad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE especialidad (
    id bigint NOT NULL,
    nombre character varying(255) NOT NULL
);


ALTER TABLE especialidad OWNER TO postgres;

--
-- Name: especialidad_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE especialidad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE especialidad_id_seq OWNER TO postgres;

--
-- Name: especialidad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE especialidad_id_seq OWNED BY especialidad.id;


--
-- Name: esperando; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE esperando (
    id bigint NOT NULL,
    especialidad bigint,
    profesional bigint,
    paciente_id bigint,
    medico bigint,
    fecha_registro timestamp(0) without time zone NOT NULL,
    status character varying(255) NOT NULL,
    penalizacion integer,
    posicion integer
);


ALTER TABLE esperando OWNER TO postgres;

--
-- Name: esperando_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE esperando_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE esperando_id_seq OWNER TO postgres;

--
-- Name: esperando_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE esperando_id_seq OWNED BY esperando.id;


--
-- Name: estado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE estado (
    id bigint NOT NULL,
    pais_id bigint,
    nombre character varying(255) NOT NULL
);


ALTER TABLE estado OWNER TO postgres;

--
-- Name: estado_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE estado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE estado_id_seq OWNER TO postgres;

--
-- Name: estado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE estado_id_seq OWNED BY estado.id;


--
-- Name: etnia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE etnia (
    id bigint NOT NULL,
    nombre character varying(255) NOT NULL
);


ALTER TABLE etnia OWNER TO postgres;

--
-- Name: etnia_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE etnia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE etnia_id_seq OWNER TO postgres;

--
-- Name: etnia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE etnia_id_seq OWNED BY etnia.id;


--
-- Name: familiar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE familiar (
    id bigint NOT NULL,
    parentesco character varying(255) NOT NULL,
    nombre character varying(255) NOT NULL,
    ocupacion character varying(255) NOT NULL
);


ALTER TABLE familiar OWNER TO postgres;

--
-- Name: familiar_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE familiar_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE familiar_id_seq OWNER TO postgres;

--
-- Name: familiar_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE familiar_id_seq OWNED BY familiar.id;


--
-- Name: fos_group; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE fos_group (
    id integer NOT NULL,
    name character varying(180) NOT NULL,
    roles text NOT NULL
);


ALTER TABLE fos_group OWNER TO postgres;

--
-- Name: COLUMN fos_group.roles; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN fos_group.roles IS '(DC2Type:array)';


--
-- Name: fos_group_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE fos_group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE fos_group_id_seq OWNER TO postgres;

--
-- Name: fos_group_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE fos_group_id_seq OWNED BY fos_group.id;


--
-- Name: fos_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE fos_user (
    id bigint NOT NULL,
    persona_id bigint,
    username character varying(180) NOT NULL,
    username_canonical character varying(180) NOT NULL,
    email character varying(180) NOT NULL,
    email_canonical character varying(180) NOT NULL,
    enabled boolean NOT NULL,
    salt character varying(255) DEFAULT NULL::character varying,
    password character varying(255) NOT NULL,
    last_login timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    confirmation_token character varying(180) DEFAULT NULL::character varying,
    password_requested_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    roles text NOT NULL
);


ALTER TABLE fos_user OWNER TO postgres;

--
-- Name: COLUMN fos_user.roles; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN fos_user.roles IS '(DC2Type:array)';


--
-- Name: fos_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE fos_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE fos_user_id_seq OWNER TO postgres;

--
-- Name: fos_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE fos_user_id_seq OWNED BY fos_user.id;


--
-- Name: fos_user_user_group; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE fos_user_user_group (
    user_id bigint NOT NULL,
    group_id integer NOT NULL
);


ALTER TABLE fos_user_user_group OWNER TO postgres;

--
-- Name: municipio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE municipio (
    id bigint NOT NULL,
    estado_id bigint,
    nombre character varying(255) NOT NULL
);


ALTER TABLE municipio OWNER TO postgres;

--
-- Name: municipio_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE municipio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE municipio_id_seq OWNER TO postgres;

--
-- Name: municipio_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE municipio_id_seq OWNED BY municipio.id;


--
-- Name: paciente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE paciente (
    id bigint NOT NULL,
    religion_id bigint,
    pfg_id bigint,
    etnia_id bigint,
    persona_id bigint,
    edo_civil character varying(255) NOT NULL,
    ocupacion character varying(255) NOT NULL,
    estudio character varying(255) NOT NULL,
    ano_aprobado character varying(255) NOT NULL,
    analfabeta boolean NOT NULL,
    fecha_nacimiento date NOT NULL,
    apellido_familia character varying(255) NOT NULL,
    cedula_jefe_familia character varying(255) NOT NULL,
    comunidad character varying(255) NOT NULL,
    fecha_actualizacion timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    fecha_registro timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


ALTER TABLE paciente OWNER TO postgres;

--
-- Name: paciente_direccion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE paciente_direccion (
    paciente_id bigint NOT NULL,
    direccion_id bigint NOT NULL
);


ALTER TABLE paciente_direccion OWNER TO postgres;

--
-- Name: paciente_familiar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE paciente_familiar (
    paciente_id bigint NOT NULL,
    familiar_id bigint NOT NULL
);


ALTER TABLE paciente_familiar OWNER TO postgres;

--
-- Name: paciente_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE paciente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE paciente_id_seq OWNER TO postgres;

--
-- Name: paciente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE paciente_id_seq OWNED BY paciente.id;


--
-- Name: pais; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pais (
    id bigint NOT NULL,
    nombre character varying(255) NOT NULL
);


ALTER TABLE pais OWNER TO postgres;

--
-- Name: pais_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pais_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pais_id_seq OWNER TO postgres;

--
-- Name: pais_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pais_id_seq OWNED BY pais.id;


--
-- Name: parroquia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE parroquia (
    id bigint NOT NULL,
    municipio_id bigint,
    nombre character varying(255) NOT NULL
);


ALTER TABLE parroquia OWNER TO postgres;

--
-- Name: parroquia_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE parroquia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE parroquia_id_seq OWNER TO postgres;

--
-- Name: parroquia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE parroquia_id_seq OWNED BY parroquia.id;


--
-- Name: patologia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE patologia (
    id bigint NOT NULL,
    paciente_id bigint,
    alergias boolean NOT NULL,
    asma boolean NOT NULL,
    neumonia boolean NOT NULL,
    tbc boolean NOT NULL,
    cardiotopia boolean NOT NULL,
    hipertension boolean NOT NULL,
    dislipidemias boolean NOT NULL,
    varices boolean NOT NULL,
    cardopatia_chag boolean NOT NULL,
    hepatopatia boolean NOT NULL,
    desnutricion boolean NOT NULL,
    diabetes boolean NOT NULL,
    obesidad boolean NOT NULL,
    gastroenteritis boolean NOT NULL,
    encoprexis boolean NOT NULL,
    enfermedad_renal boolean NOT NULL,
    eunereis boolean NOT NULL,
    cancer boolean NOT NULL,
    tromboembolia boolean NOT NULL,
    tumor_m boolean NOT NULL,
    meningitis boolean NOT NULL,
    t_craneoenc boolean NOT NULL,
    enfermedad_erup boolean NOT NULL,
    dengue boolean NOT NULL,
    hospitalizacion boolean NOT NULL,
    intervencion_quirurgica boolean NOT NULL,
    accidente boolean NOT NULL,
    artritis boolean NOT NULL,
    enfermedad_ts boolean NOT NULL,
    enfermedad_in_tran boolean NOT NULL,
    malaria boolean NOT NULL,
    hansen_leishmar boolean NOT NULL,
    otros boolean NOT NULL,
    fecha_registro date NOT NULL,
    fecha_actualizacion date NOT NULL
);


ALTER TABLE patologia OWNER TO postgres;

--
-- Name: patologia_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE patologia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE patologia_id_seq OWNER TO postgres;

--
-- Name: patologia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE patologia_id_seq OWNED BY patologia.id;


--
-- Name: perinatal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE perinatal (
    id bigint NOT NULL,
    paciente_id bigint,
    carnet_perinatal boolean NOT NULL,
    patologia_embarazo boolean NOT NULL,
    patologia_parto boolean NOT NULL,
    patologia_puerperio boolean NOT NULL,
    consultas_prenatales boolean NOT NULL,
    edad_gestacional integer NOT NULL,
    forceps boolean NOT NULL,
    cesarea boolean NOT NULL,
    parto boolean NOT NULL,
    peso_nacer integer NOT NULL,
    talla integer NOT NULL,
    circunferencia integer NOT NULL,
    apagar_min boolean NOT NULL,
    asfixia boolean NOT NULL,
    reanimacion boolean NOT NULL,
    patologias_rn boolean NOT NULL,
    egreso_rn_sano boolean NOT NULL,
    egreso_rn_patologico boolean NOT NULL,
    lactancia_exclusiva boolean NOT NULL,
    lactancia_mixta boolean NOT NULL,
    lactancia_aglactacion boolean NOT NULL,
    madre_fuera_casa integer NOT NULL,
    familia_madre boolean NOT NULL,
    familia_padre boolean NOT NULL,
    familia_hermanos boolean NOT NULL,
    familia_otros boolean NOT NULL,
    fecha_registro date NOT NULL,
    fecha_actualizacion date NOT NULL
);


ALTER TABLE perinatal OWNER TO postgres;

--
-- Name: perinatal_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE perinatal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE perinatal_id_seq OWNER TO postgres;

--
-- Name: perinatal_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE perinatal_id_seq OWNED BY perinatal.id;


--
-- Name: persona; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE persona (
    id bigint NOT NULL,
    nacionalidad character varying(1) NOT NULL,
    cedula character varying(255) NOT NULL,
    primer_apellido character varying(255) NOT NULL,
    segundo_apellido character varying(255) DEFAULT NULL::character varying,
    primer_nombre character varying(255) NOT NULL,
    segundo_nombre character varying(255) DEFAULT NULL::character varying,
    genero character varying(1) NOT NULL,
    telefono character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    foto character varying(255) DEFAULT NULL::character varying,
    fecha_actualizacion timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    fecha_registro timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


ALTER TABLE persona OWNER TO postgres;

--
-- Name: persona_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE persona_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE persona_id_seq OWNER TO postgres;

--
-- Name: persona_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE persona_id_seq OWNED BY persona.id;


--
-- Name: pfg; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pfg (
    id bigint NOT NULL,
    nombre character varying(255) NOT NULL
);


ALTER TABLE pfg OWNER TO postgres;

--
-- Name: pfg_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pfg_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pfg_id_seq OWNER TO postgres;

--
-- Name: pfg_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pfg_id_seq OWNED BY pfg.id;


--
-- Name: profesional; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE profesional (
    id bigint NOT NULL,
    persona_id bigint,
    codigo_ssa character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE profesional OWNER TO postgres;

--
-- Name: profesional_especialidad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE profesional_especialidad (
    id bigint NOT NULL,
    especialidad_id bigint,
    profesional_id bigint
);


ALTER TABLE profesional_especialidad OWNER TO postgres;

--
-- Name: profesional_especialidad_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE profesional_especialidad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE profesional_especialidad_id_seq OWNER TO postgres;

--
-- Name: profesional_especialidad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE profesional_especialidad_id_seq OWNED BY profesional_especialidad.id;


--
-- Name: profesional_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE profesional_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE profesional_id_seq OWNER TO postgres;

--
-- Name: profesional_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE profesional_id_seq OWNED BY profesional.id;


--
-- Name: religion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE religion (
    id bigint NOT NULL,
    nombre character varying(255) NOT NULL
);


ALTER TABLE religion OWNER TO postgres;

--
-- Name: religion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE religion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE religion_id_seq OWNER TO postgres;

--
-- Name: religion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE religion_id_seq OWNED BY religion.id;


--
-- Name: representante; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE representante (
    id bigint NOT NULL,
    paciente_id bigint,
    nacionalidad character varying(1) NOT NULL,
    cedula character varying(255) NOT NULL,
    nombre_apellido character varying(255) NOT NULL,
    parentesco character varying(255) NOT NULL,
    telefono character varying(255) NOT NULL
);


ALTER TABLE representante OWNER TO postgres;

--
-- Name: representante_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE representante_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE representante_id_seq OWNER TO postgres;

--
-- Name: representante_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE representante_id_seq OWNED BY representante.id;


--
-- Name: servicio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE servicio (
    id integer NOT NULL,
    especialidad_id bigint,
    turno character varying(255) NOT NULL,
    procedencia character varying(255) NOT NULL,
    cupo integer NOT NULL,
    disponible integer,
    fecha date,
    dia character varying(255) NOT NULL
);


ALTER TABLE servicio OWNER TO postgres;

--
-- Name: servicio_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE servicio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE servicio_id_seq OWNER TO postgres;

--
-- Name: servicio_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE servicio_id_seq OWNED BY servicio.id;


--
-- Name: servicio_profesional; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE servicio_profesional (
    id integer NOT NULL,
    servicio_id integer,
    profesional_id bigint,
    status character varying(255) NOT NULL,
    fecha_actualizacion timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    observacion text
);


ALTER TABLE servicio_profesional OWNER TO postgres;

--
-- Name: servicio_profesional_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE servicio_profesional_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE servicio_profesional_id_seq OWNER TO postgres;

--
-- Name: servicio_profesional_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE servicio_profesional_id_seq OWNED BY servicio_profesional.id;


--
-- Name: sexualidad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE sexualidad (
    id bigint NOT NULL,
    paciente_id bigint,
    menarquia character varying(255) NOT NULL,
    ciclo_menstrual character varying(255) NOT NULL,
    pr_sexual character varying(255) NOT NULL,
    frecuencia_sexual character varying(255) NOT NULL,
    numero_parejas integer NOT NULL,
    dispareunia boolean NOT NULL,
    anticonceptivos boolean NOT NULL,
    menopausia boolean NOT NULL,
    andropausia boolean NOT NULL,
    gesta boolean NOT NULL,
    parto boolean NOT NULL,
    cesarea boolean NOT NULL,
    aborto boolean NOT NULL,
    edad_1er_parto integer,
    fecha_ultimo_parto date,
    curetaje boolean NOT NULL,
    numero_hijos_vivos integer NOT NULL,
    numero_hijos_muertos integer NOT NULL,
    peso_ultimo_hijo integer NOT NULL,
    fecha_actualizacion date NOT NULL,
    fecha_registro date NOT NULL
);


ALTER TABLE sexualidad OWNER TO postgres;

--
-- Name: sexualidad_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sexualidad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sexualidad_id_seq OWNER TO postgres;

--
-- Name: sexualidad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sexualidad_id_seq OWNED BY sexualidad.id;


--
-- Name: sicobiologico; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE sicobiologico (
    id bigint NOT NULL,
    paciente_id bigint,
    alcohol boolean NOT NULL,
    drogas boolean NOT NULL,
    isecticidas boolean NOT NULL,
    deportes boolean NOT NULL,
    sedentarismo boolean NOT NULL,
    suenio boolean NOT NULL,
    chupa_dedo boolean NOT NULL,
    onicofagia boolean NOT NULL,
    micciones boolean NOT NULL,
    evacuaciones boolean NOT NULL,
    stress boolean NOT NULL,
    metales_pesados boolean NOT NULL,
    alimentacion boolean NOT NULL,
    cigarrillos_dia boolean NOT NULL,
    fecha_registro date NOT NULL,
    fecha_actualizacion date NOT NULL
);


ALTER TABLE sicobiologico OWNER TO postgres;

--
-- Name: sicobiologico_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sicobiologico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sicobiologico_id_seq OWNER TO postgres;

--
-- Name: sicobiologico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sicobiologico_id_seq OWNED BY sicobiologico.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY antecendente ALTER COLUMN id SET DEFAULT nextval('antecendente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cita ALTER COLUMN id SET DEFAULT nextval('cita_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY configuracion ALTER COLUMN id SET DEFAULT nextval('configuracion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY consulta ALTER COLUMN id SET DEFAULT nextval('consulta_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY direccion ALTER COLUMN id SET DEFAULT nextval('direccion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY disponible ALTER COLUMN id SET DEFAULT nextval('disponible_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY especialidad ALTER COLUMN id SET DEFAULT nextval('especialidad_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY esperando ALTER COLUMN id SET DEFAULT nextval('esperando_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estado ALTER COLUMN id SET DEFAULT nextval('estado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY etnia ALTER COLUMN id SET DEFAULT nextval('etnia_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY familiar ALTER COLUMN id SET DEFAULT nextval('familiar_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY fos_group ALTER COLUMN id SET DEFAULT nextval('fos_group_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY fos_user ALTER COLUMN id SET DEFAULT nextval('fos_user_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY municipio ALTER COLUMN id SET DEFAULT nextval('municipio_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente ALTER COLUMN id SET DEFAULT nextval('paciente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pais ALTER COLUMN id SET DEFAULT nextval('pais_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parroquia ALTER COLUMN id SET DEFAULT nextval('parroquia_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY patologia ALTER COLUMN id SET DEFAULT nextval('patologia_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY perinatal ALTER COLUMN id SET DEFAULT nextval('perinatal_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY persona ALTER COLUMN id SET DEFAULT nextval('persona_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pfg ALTER COLUMN id SET DEFAULT nextval('pfg_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY profesional ALTER COLUMN id SET DEFAULT nextval('profesional_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY profesional_especialidad ALTER COLUMN id SET DEFAULT nextval('profesional_especialidad_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY religion ALTER COLUMN id SET DEFAULT nextval('religion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY representante ALTER COLUMN id SET DEFAULT nextval('representante_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY servicio ALTER COLUMN id SET DEFAULT nextval('servicio_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY servicio_profesional ALTER COLUMN id SET DEFAULT nextval('servicio_profesional_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sexualidad ALTER COLUMN id SET DEFAULT nextval('sexualidad_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sicobiologico ALTER COLUMN id SET DEFAULT nextval('sicobiologico_id_seq'::regclass);


--
-- Data for Name: antecendente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY antecendente (id, paciente_id, alergia, asma, tbc, cardiotopia, hipertension, varices, desnutricion, diabetes, obesidad, gastropatia, neurologica, enfermedad_renal, cancer, alcohol, drogas, sifilis, sida, artritis, otros_padre, otros_madre, otros_hermanos, otros, fecha_actualizacion, fecha_registro) FROM stdin;
\.


--
-- Name: antecendente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('antecendente_id_seq', 1, false);


--
-- Data for Name: cita; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cita (id, especialidad_id, consulta_id, profesional_id, paciente_id, fecha, status) FROM stdin;
2	5	1	2	9	2017-03-20	activo
3	6	\N	21	12	2017-04-06	activo
\.


--
-- Name: cita_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cita_id_seq', 3, true);


--
-- Data for Name: configuracion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY configuracion (id, numero_consultas, servicio_actualizado, tiempo_espera, penalizacion) FROM stdin;
1	2	2017-04-06	60	3
\.


--
-- Name: configuracion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('configuracion_id_seq', 1, true);


--
-- Data for Name: consulta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY consulta (id, nombre) FROM stdin;
1	Consultum
\.


--
-- Name: consulta_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('consulta_id_seq', 1, true);


--
-- Data for Name: direccion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY direccion (id, parroquia_id, tipo, sector) FROM stdin;
2	1	nacimiento	Sector
1	1	habitacion Tipo	Sector
3	1	habitacion	SAN MARTIN
4	1	nacimiento	LAS BRISAS EL PARAISO
5	1	habitacion	LAS BRISAS EL PARAISO
6	1	nacimiento	240 NW 107th Ave APT 211 Miami FL
8	1	habitacion	Procedencia
9	1	habitacion	Sector
10	1	habitacion	Sector
11	1	habitacion	LAS BRISAS EL PARAISO
12	1	habitacion	LAS BRISAS EL PARAISO
13	1	nacimiento	SAN MARTIN, CARACAS
14	1	habitacion	Las Adjuntas
15	1	nacimiento	Caucagua
16	1	nacimiento	Los Rosales
17	1	habitacion	Los Roslaes
18	1	habitacion	XZS
19	1	habitacion	LAS BRISAS EL PARAISO
20	1	nacimiento	LAS BRISAS EL PARAISO
21	1	habitacion	LAS BRISAS EL PARAISO
22	1	nacimiento	EL PARAISO
\.


--
-- Name: direccion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('direccion_id_seq', 22, true);


--
-- Data for Name: disponible; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY disponible (id, profesional_especialidad_id, fecha, consultorio, status) FROM stdin;
\.


--
-- Name: disponible_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('disponible_id_seq', 6, true);


--
-- Data for Name: especialidad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY especialidad (id, nombre) FROM stdin;
1	Gine-obstetricia
2	Nutrición y Dietética
3	Pediatría
4	Medicina Interna
5	Medicina General
6	Odontología
7	Psicología
8	Trabajo Social
\.


--
-- Name: especialidad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('especialidad_id_seq', 8, true);


--
-- Data for Name: esperando; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY esperando (id, especialidad, profesional, paciente_id, medico, fecha_registro, status, penalizacion, posicion) FROM stdin;
52	3	2	10	\N	2017-03-23 09:25:00	cancelado	1	\N
53	3	\N	9	\N	2017-03-23 09:26:00	abandono	3	\N
44	5	2	9	\N	2017-03-20 16:28:00	abandono	\N	\N
46	5	2	9	\N	2017-03-22 08:51:00	abandono	3	\N
48	5	\N	10	\N	2017-03-22 09:02:00	atendido	2	\N
47	5	2	4	\N	2017-03-22 08:53:00	atendido	1	\N
50	4	\N	4	\N	2017-03-22 11:43:00	atendido	1	\N
51	3	\N	4	\N	2017-03-23 09:24:00	atendido	1	\N
54	3	\N	10	\N	2017-03-23 10:51:00	atendido	0	\N
55	3	\N	4	\N	2017-03-23 10:53:16	atendido	0	\N
58	3	\N	12	\N	2017-03-23 15:46:00	abandono	2	\N
59	3	\N	10	\N	2017-03-24 10:04:00	abandono	2	\N
60	3	\N	10	\N	2017-03-28 09:41:15	abandono	0	\N
61	3	\N	12	\N	2017-03-29 07:18:12	abandono	0	\N
62	3	\N	12	\N	2017-03-31 16:47:27	abandono	0	\N
63	3	\N	10	\N	2017-04-01 18:33:00	abandono	0	\N
64	5	\N	10	\N	2017-04-02 11:05:00	abandono	0	\N
65	3	\N	12	\N	2017-04-02 19:18:40	abandono	0	\N
71	3	\N	10	3	2017-04-05 09:32:45	atendido	2	\N
67	1	21	12	3	2017-04-03 08:42:00	abandono	0	\N
66	1	\N	10	3	2017-04-03 08:42:00	abandono	2	\N
68	2	\N	12	2	2017-04-04 14:35:00	atendido	2	\N
69	3	\N	9	\N	2017-04-04 14:36:04	abandono	0	\N
70	6	\N	18	\N	2017-04-04 14:36:23	abandono	0	\N
74	6	\N	4	\N	2017-04-05 11:36:28	abandono	0	\N
72	6	\N	12	3	2017-04-05 09:33:00	abandono	1	\N
75	3	\N	10	\N	2017-04-06 16:25:15	activo	0	1
76	6	\N	10	\N	2017-04-06 16:25:56	activo	0	2
77	3	\N	12	\N	2017-04-06 16:29:29	activo	0	3
79	6	\N	12	\N	2017-04-06 16:31:43	activo	0	4
\.


--
-- Name: esperando_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('esperando_id_seq', 79, true);


--
-- Data for Name: estado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY estado (id, pais_id, nombre) FROM stdin;
1	1	Distrito Federal
\.


--
-- Name: estado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('estado_id_seq', 1, true);


--
-- Data for Name: etnia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY etnia (id, nombre) FROM stdin;
3	Kariña
4	Baniva o kurripako
5	Piapoko
6	Pemón
7	Panare
8	Yukpa
9	Chaima
10	Japrería
11	Maquiritare o Yekuana
12	Akawayo
13	Yabarana
14	Mapoyo
15	Yanomami
16	Sanema
17	Barí
18	Puinave
19	Hoti
20	Tupí
21	Makko
22	Sáliba
23	Wottuja-Piaroa
24	Cuiva
25	Waraos
26	Waikerí
27	Pumé
28	Sapé
1	Wayúu2
2	Añú
\.


--
-- Name: etnia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('etnia_id_seq', 28, true);


--
-- Data for Name: familiar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY familiar (id, parentesco, nombre, ocupacion) FROM stdin;
1	padre	Procedencia	Procedencia
3	madre	Nombre	Ocupacion
4	padre	Familiares Nombre	Ocupacion
5	padre	Familiares Nombre	Ocupacion
6	padre	Sector	Sector
7	padre	JORGE A HERNANDEZ	Ocupacion
8	otro	Waldo Vergara	Ocupacion
2	madre	JORGE A HERNANDEZ	Ocupacion
9	padre	JORGE A HERNANDEZ	Mecanico
10	padre	Pedro Flores	Jubilado
11	madre	Iris Fernandez	Docente
12	padre	Centeno	Amo de Casa
13	padre	JORGE A HERNANDEZ	Procedencia
14	madre	OSCAR D VELASQUEZ	Ocupacion
15	padre	JORGE A HERNANDEZ	Procedencia
16	madre	Waldo Vergara	Ocupacion
\.


--
-- Name: familiar_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('familiar_id_seq', 16, true);


--
-- Data for Name: fos_group; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY fos_group (id, name, roles) FROM stdin;
\.


--
-- Name: fos_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('fos_group_id_seq', 1, false);


--
-- Data for Name: fos_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY fos_user (id, persona_id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles) FROM stdin;
3	46	recepcion	recepcion	ovelasquez@ubv.edu.ve	ovelasquez@ubv.edu.ve	t	\N	$2y$13$pyvN9YuNLPBQyuuimZuBz.u.jBQN1cR3aTeDdr6rs4YYE/JA9S8wS	2017-04-05 09:46:44	\N	\N	a:1:{i:0;s:14:"ROLE_RECEPCION";}
1	8	admin	admin	velasquez.oscar@gmail.com	velasquez.oscar@gmail.com	t	\N	$2y$13$RfS8Ax50FqjabxPu20FmIOTWuQ5odDDOWvyv1vi03N1suW/DFKaTO	2017-04-06 16:06:13	\N	\N	a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}
2	11	bbravo	bbravo	betbravopasantias@gmail.com	betbravopasantias@gmail.com	t	\N	$2y$13$un74W.HbJH2Es9PDOGC7TORHkprlxFu7Gv1hf4wbRuStDy/b2Igb6	2017-04-06 16:14:19	\N	\N	a:1:{i:0;s:11:"ROLE_MEDICO";}
\.


--
-- Name: fos_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('fos_user_id_seq', 1, false);


--
-- Data for Name: fos_user_user_group; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY fos_user_user_group (user_id, group_id) FROM stdin;
\.


--
-- Data for Name: municipio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY municipio (id, estado_id, nombre) FROM stdin;
1	1	Libertador
\.


--
-- Name: municipio_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('municipio_id_seq', 1, true);


--
-- Data for Name: paciente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY paciente (id, religion_id, pfg_id, etnia_id, persona_id, edo_civil, ocupacion, estudio, ano_aprobado, analfabeta, fecha_nacimiento, apellido_familia, cedula_jefe_familia, comunidad, fecha_actualizacion, fecha_registro) FROM stdin;
10	1	\N	\N	23	casado	Computación	universitaria	5	f	1982-04-06	Velasquez	15217394	comunidad	2017-03-23 13:37:44	2017-03-21 09:01:39
12	1	\N	3	25	soltero	Estudiante	universitaria	5	f	1991-02-16	Centeno Medina	10525610	comunidad	\N	2017-03-23 15:46:38
9	1	\N	19	21	soltero	Empleada	universitaria	5	f	1972-11-01	Vegas	0	administrativo	2017-04-01 20:37:41	2017-03-07 06:53:35
4	3	\N	\N	11	casado	Estudiante	universitaria	5	f	2000-12-01	Bravo	5877494	administrativo	2017-04-01 20:53:43	2017-03-01 10:00:00
18	1	\N	\N	8	casado	Médico	universitaria	5	f	1969-12-31	Velasquez	4922288	administrativo	2017-04-03 08:40:11	2017-03-29 21:59:22
20	1	\N	\N	46	soltero	Recepcionista	secundaria	5	f	1897-01-01	Recepción	1234567890	administrativo	\N	2017-04-05 09:39:02
19	1	\N	\N	45	soltero	Médico	universitaria	5	f	1969-12-31	Vasquez	4922288	administrativo	2017-04-06 16:12:31	2017-04-01 23:25:34
\.


--
-- Data for Name: paciente_direccion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY paciente_direccion (paciente_id, direccion_id) FROM stdin;
4	2
4	11
9	12
9	13
10	14
10	15
12	18
\.


--
-- Data for Name: paciente_familiar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY paciente_familiar (paciente_id, familiar_id) FROM stdin;
4	2
4	7
4	8
9	9
10	10
10	11
12	12
\.


--
-- Name: paciente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('paciente_id_seq', 20, true);


--
-- Data for Name: pais; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pais (id, nombre) FROM stdin;
1	República Bolivariana de Venezuela
\.


--
-- Name: pais_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pais_id_seq', 1, true);


--
-- Data for Name: parroquia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY parroquia (id, municipio_id, nombre) FROM stdin;
1	1	Macarao
\.


--
-- Name: parroquia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('parroquia_id_seq', 1, true);


--
-- Data for Name: patologia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY patologia (id, paciente_id, alergias, asma, neumonia, tbc, cardiotopia, hipertension, dislipidemias, varices, cardopatia_chag, hepatopatia, desnutricion, diabetes, obesidad, gastroenteritis, encoprexis, enfermedad_renal, eunereis, cancer, tromboembolia, tumor_m, meningitis, t_craneoenc, enfermedad_erup, dengue, hospitalizacion, intervencion_quirurgica, accidente, artritis, enfermedad_ts, enfermedad_in_tran, malaria, hansen_leishmar, otros, fecha_registro, fecha_actualizacion) FROM stdin;
\.


--
-- Name: patologia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('patologia_id_seq', 1, false);


--
-- Data for Name: perinatal; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY perinatal (id, paciente_id, carnet_perinatal, patologia_embarazo, patologia_parto, patologia_puerperio, consultas_prenatales, edad_gestacional, forceps, cesarea, parto, peso_nacer, talla, circunferencia, apagar_min, asfixia, reanimacion, patologias_rn, egreso_rn_sano, egreso_rn_patologico, lactancia_exclusiva, lactancia_mixta, lactancia_aglactacion, madre_fuera_casa, familia_madre, familia_padre, familia_hermanos, familia_otros, fecha_registro, fecha_actualizacion) FROM stdin;
\.


--
-- Name: perinatal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('perinatal_id_seq', 1, false);


--
-- Data for Name: persona; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY persona (id, nacionalidad, cedula, primer_apellido, segundo_apellido, primer_nombre, segundo_nombre, genero, telefono, email, foto, fecha_actualizacion, fecha_registro) FROM stdin;
22	V	963852741	Vergara	Zambrano	Betania	Maria	F	04261234567	profesional@ubv.edu.ve	b0793e7468b63ee2b52c909947042518.jpeg	2017-03-16 13:20:08	2017-03-13 07:44:35
23	V	15457549	Flores	Fernandez	Mariana	Mercedes	F	04264165888	marianamff@gmail.com	fba9e9c083883951ead4121fd1d36591.jpeg	\N	\N
25	V	21090578	Centeno	Medina	Virgilio	José	M	04268108575	centeno365.vc@gmail.com	user.png	\N	2017-03-23 15:46:38
21	V	11064078	Vegas	Rodriguez	Beatriz	Del Carmen	F	04169186948	beatrizdelcarmenvegas@gmail.com	fba897054b978f4ae8ec4486040078e0.jpeg	\N	2017-04-01 20:37:41
11	V	19852039	Bravo	Bracho	Betsabe	Dalilas	F	04263067797	betbravopasantias@gmail.com	63d5a668a902998a8009ee3470dd10f7.jpeg	\N	\N
46	V	85265478965	Recepción	\N	Sala	\N	F	123456	ovelasquez@ubv.edu.ve	08e18600887ccf8ba71bdb4c6a68d221.jpeg	\N	2017-04-05 09:39:02
8	V	15217394	Velásquez	\N	Oscar	Daniel	M	04262055929	velasquez.oscar@gmail.com	399a4b0783576952e2258094e8111db0.jpeg	2017-04-06 16:07:56	\N
45	V	4922288	Azuaje	Rodrigues	Ana	Maria	F	02722057048	atocha@gmail.com	658b36dcae8893e6e36f7c2351ea333e.jpeg	\N	2017-04-01 23:25:34
\.


--
-- Name: persona_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('persona_id_seq', 46, true);


--
-- Data for Name: pfg; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pfg (id, nombre) FROM stdin;
1	Agroecología
2	Arquitectura
3	Comunicación Social
4	Economía Política
5	Estudios Jurídicos
6	Estudios Políticos y de Gobierno
7	Gas
8	Gestión Ambiental
9	Gestión en Salud Pública
10	Gstión Social del Desarrollo Local
11	Informática para la Gestión Social
12	Pesca y Acuicultura
13	Petróleo
14	Psicología
15	Radioterapia
16	Refinación y Petroquímica
17	Relaciones Internacionales
\.


--
-- Name: pfg_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pfg_id_seq', 17, true);


--
-- Data for Name: profesional; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY profesional (id, persona_id, codigo_ssa) FROM stdin;
3	11	123456**
2	8	123456890
21	45	wewew2435432
\.


--
-- Data for Name: profesional_especialidad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY profesional_especialidad (id, especialidad_id, profesional_id) FROM stdin;
2	5	2
3	5	3
\.


--
-- Name: profesional_especialidad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('profesional_especialidad_id_seq', 5, true);


--
-- Name: profesional_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('profesional_id_seq', 21, true);


--
-- Data for Name: religion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY religion (id, nombre) FROM stdin;
2	Evangelismo
3	Testigos de Jehová
1	Catolicismo
\.


--
-- Name: religion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('religion_id_seq', 3, true);


--
-- Data for Name: representante; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY representante (id, paciente_id, nacionalidad, cedula, nombre_apellido, parentesco, telefono) FROM stdin;
\.


--
-- Name: representante_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('representante_id_seq', 1, false);


--
-- Data for Name: servicio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY servicio (id, especialidad_id, turno, procedencia, cupo, disponible, fecha, dia) FROM stdin;
4	5	mixto	UBV	10	10	2017-03-31	5
9	1	mañana	UBV	10	10	2017-03-31	5
14	2	mañana	UBV	10	10	2017-03-31	5
26	4	mañana	UBV	10	10	2017-03-31	5
31	6	mixto	UBV	10	10	2017-03-31	5
36	7	mixto	UBV	10	10	2017-03-31	5
21	3	mañana	Mixto	10	9	2017-03-31	5
37	3	mixto	UBV	10	9	2017-04-01	6
38	5	mañana	UBV	5	\N	\N	6
42	5	mañana	UBV	10	9	2017-04-02	0
41	3	mañana	UBV	10	9	2017-04-02	0
22	4	mañana	UBV	10	10	2017-04-03	1
27	6	mixto	UBV	10	10	2017-04-03	1
32	7	mixto	UBV	10	10	2017-04-03	1
12	2	mañana	UBV	10	10	2017-04-03	1
7	1	mañana	UBV	10	10	2017-04-03	1
17	3	mañana	Mixto	10	9	2017-04-03	1
2	5	mixto	UBV	10	9	2017-04-03	1
33	7	mixto	Comunidad	10	10	2017-04-04	2
10	1	mañana	Comunidad	10	10	2017-04-04	2
23	4	mañana	Comunidad	10	10	2017-04-04	2
6	5	mixto	Comunidad	10	10	2017-04-04	2
15	2	mañana	Comunidad	10	9	2017-04-04	2
18	3	mañana	Mixto	10	9	2017-04-04	2
28	6	mixto	Comunidad	10	9	2017-04-04	2
34	7	mixto	UBV	10	10	2017-04-05	3
3	5	mixto	UBV	10	10	2017-04-05	3
8	1	mañana	UBV	10	10	2017-04-05	3
13	2	mañana	UBV	10	10	2017-04-05	3
24	4	mañana	UBV	10	10	2017-04-05	3
19	3	mañana	Mixto	10	9	2017-04-05	3
29	6	mixto	UBV	10	7	2017-04-05	3
16	1	mañana	Comunidad	10	10	2017-03-23	6
35	7	mixto	Comunidad	10	10	2017-04-06	4
5	5	mixto	Comunidad	10	10	2017-04-06	4
11	1	mañana	Comunidad	10	10	2017-04-06	4
25	4	mañana	Comunidad	10	10	2017-04-06	4
20	3	mañana	Mixto	10	8	2017-04-06	4
30	6	mixto	Comunidad	10	7	2017-04-06	4
\.


--
-- Name: servicio_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('servicio_id_seq', 42, true);


--
-- Data for Name: servicio_profesional; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY servicio_profesional (id, servicio_id, profesional_id, status, fecha_actualizacion, observacion) FROM stdin;
3	20	2	activo	2017-04-06 16:11:49	Participa en el II Congreso de Salud Publica en Nueva York
6	30	3	activo	2017-04-06 16:11:51	\N
7	30	21	inactivo	2017-04-06 16:27:03	Unidad de los Servicios de Salud Integral Dr. Jesús Saturno Canelón
\.


--
-- Name: servicio_profesional_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('servicio_profesional_id_seq', 7, true);


--
-- Data for Name: sexualidad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sexualidad (id, paciente_id, menarquia, ciclo_menstrual, pr_sexual, frecuencia_sexual, numero_parejas, dispareunia, anticonceptivos, menopausia, andropausia, gesta, parto, cesarea, aborto, edad_1er_parto, fecha_ultimo_parto, curetaje, numero_hijos_vivos, numero_hijos_muertos, peso_ultimo_hijo, fecha_actualizacion, fecha_registro) FROM stdin;
\.


--
-- Name: sexualidad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sexualidad_id_seq', 1, false);


--
-- Data for Name: sicobiologico; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sicobiologico (id, paciente_id, alcohol, drogas, isecticidas, deportes, sedentarismo, suenio, chupa_dedo, onicofagia, micciones, evacuaciones, stress, metales_pesados, alimentacion, cigarrillos_dia, fecha_registro, fecha_actualizacion) FROM stdin;
\.


--
-- Name: sicobiologico_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sicobiologico_id_seq', 1, false);


--
-- Name: antecendente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY antecendente
    ADD CONSTRAINT antecendente_pkey PRIMARY KEY (id);


--
-- Name: cita_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cita
    ADD CONSTRAINT cita_pkey PRIMARY KEY (id);


--
-- Name: configuracion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY configuracion
    ADD CONSTRAINT configuracion_pkey PRIMARY KEY (id);


--
-- Name: consulta_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY consulta
    ADD CONSTRAINT consulta_pkey PRIMARY KEY (id);


--
-- Name: direccion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY direccion
    ADD CONSTRAINT direccion_pkey PRIMARY KEY (id);


--
-- Name: disponible_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY disponible
    ADD CONSTRAINT disponible_pkey PRIMARY KEY (id);


--
-- Name: especialidad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY especialidad
    ADD CONSTRAINT especialidad_pkey PRIMARY KEY (id);


--
-- Name: esperando_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY esperando
    ADD CONSTRAINT esperando_pkey PRIMARY KEY (id);


--
-- Name: estado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estado
    ADD CONSTRAINT estado_pkey PRIMARY KEY (id);


--
-- Name: etnia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY etnia
    ADD CONSTRAINT etnia_pkey PRIMARY KEY (id);


--
-- Name: familiar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY familiar
    ADD CONSTRAINT familiar_pkey PRIMARY KEY (id);


--
-- Name: fos_group_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY fos_group
    ADD CONSTRAINT fos_group_pkey PRIMARY KEY (id);


--
-- Name: fos_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY fos_user
    ADD CONSTRAINT fos_user_pkey PRIMARY KEY (id);


--
-- Name: fos_user_user_group_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fos_user_user_group_pkey PRIMARY KEY (user_id, group_id);


--
-- Name: municipio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY municipio
    ADD CONSTRAINT municipio_pkey PRIMARY KEY (id);


--
-- Name: paciente_direccion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_direccion
    ADD CONSTRAINT paciente_direccion_pkey PRIMARY KEY (paciente_id, direccion_id);


--
-- Name: paciente_familiar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_familiar
    ADD CONSTRAINT paciente_familiar_pkey PRIMARY KEY (paciente_id, familiar_id);


--
-- Name: paciente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente
    ADD CONSTRAINT paciente_pkey PRIMARY KEY (id);


--
-- Name: pais_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pais
    ADD CONSTRAINT pais_pkey PRIMARY KEY (id);


--
-- Name: parroquia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parroquia
    ADD CONSTRAINT parroquia_pkey PRIMARY KEY (id);


--
-- Name: patologia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY patologia
    ADD CONSTRAINT patologia_pkey PRIMARY KEY (id);


--
-- Name: perinatal_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY perinatal
    ADD CONSTRAINT perinatal_pkey PRIMARY KEY (id);


--
-- Name: persona_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY persona
    ADD CONSTRAINT persona_pkey PRIMARY KEY (id);


--
-- Name: pfg_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pfg
    ADD CONSTRAINT pfg_pkey PRIMARY KEY (id);


--
-- Name: profesional_especialidad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY profesional_especialidad
    ADD CONSTRAINT profesional_especialidad_pkey PRIMARY KEY (id);


--
-- Name: profesional_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY profesional
    ADD CONSTRAINT profesional_pkey PRIMARY KEY (id);


--
-- Name: religion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY religion
    ADD CONSTRAINT religion_pkey PRIMARY KEY (id);


--
-- Name: representante_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY representante
    ADD CONSTRAINT representante_pkey PRIMARY KEY (id);


--
-- Name: servicio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY servicio
    ADD CONSTRAINT servicio_pkey PRIMARY KEY (id);


--
-- Name: servicio_profesional_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY servicio_profesional
    ADD CONSTRAINT servicio_profesional_pkey PRIMARY KEY (id);


--
-- Name: sexualidad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sexualidad
    ADD CONSTRAINT sexualidad_pkey PRIMARY KEY (id);


--
-- Name: sicobiologico_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sicobiologico
    ADD CONSTRAINT sicobiologico_pkey PRIMARY KEY (id);


--
-- Name: idx_142f08677310dad4; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_142f08677310dad4 ON perinatal USING btree (paciente_id);


--
-- Name: idx_17fb1f757310dad4; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_17fb1f757310dad4 ON patologia USING btree (paciente_id);


--
-- Name: idx_23a7166858bc1be0; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_23a7166858bc1be0 ON parroquia USING btree (municipio_id);


--
-- Name: idx_23bcdfc37da9b47f; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_23bcdfc37da9b47f ON disponible USING btree (profesional_especialidad_id);


--
-- Name: idx_265de1e3c604d5c6; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_265de1e3c604d5c6 ON estado USING btree (pais_id);


--
-- Name: idx_2bb32e08f5f88db9; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_2bb32e08f5f88db9 ON profesional USING btree (persona_id);


--
-- Name: idx_2c3c3d7e16a490ec; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_2c3c3d7e16a490ec ON profesional_especialidad USING btree (especialidad_id);


--
-- Name: idx_2c3c3d7e313d7fb9; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_2c3c3d7e313d7fb9 ON profesional_especialidad USING btree (profesional_id);


--
-- Name: idx_3e379a6216a490ec; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_3e379a6216a490ec ON cita USING btree (especialidad_id);


--
-- Name: idx_3e379a62313d7fb9; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_3e379a62313d7fb9 ON cita USING btree (profesional_id);


--
-- Name: idx_3e379a627310dad4; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_3e379a627310dad4 ON cita USING btree (paciente_id);


--
-- Name: idx_3e379a62e38d288b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_3e379a62e38d288b ON cita USING btree (consulta_id);


--
-- Name: idx_82dad52e7310dad4; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_82dad52e7310dad4 ON sicobiologico USING btree (paciente_id);


--
-- Name: idx_872e9511313d7fb9; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_872e9511313d7fb9 ON servicio_profesional USING btree (profesional_id);


--
-- Name: idx_872e951171caa3e7; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_872e951171caa3e7 ON servicio_profesional USING btree (servicio_id);


--
-- Name: idx_894685ce7310dad4; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_894685ce7310dad4 ON sexualidad USING btree (paciente_id);


--
-- Name: idx_957a6479f5f88db9; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_957a6479f5f88db9 ON fos_user USING btree (persona_id);


--
-- Name: idx_a2cddfa510c20d71; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_a2cddfa510c20d71 ON paciente_familiar USING btree (familiar_id);


--
-- Name: idx_a2cddfa57310dad4; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_a2cddfa57310dad4 ON paciente_familiar USING btree (paciente_id);


--
-- Name: idx_b3c77447a76ed395; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_b3c77447a76ed395 ON fos_user_user_group USING btree (user_id);


--
-- Name: idx_b3c77447fe54d947; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_b3c77447fe54d947 ON fos_user_user_group USING btree (group_id);


--
-- Name: idx_c24a09bc7310dad4; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_c24a09bc7310dad4 ON antecendente USING btree (paciente_id);


--
-- Name: idx_c6cba95e594872dc; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_c6cba95e594872dc ON paciente USING btree (etnia_id);


--
-- Name: idx_c6cba95e9363fd17; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_c6cba95e9363fd17 ON paciente USING btree (pfg_id);


--
-- Name: idx_c6cba95eb7850cbd; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_c6cba95eb7850cbd ON paciente USING btree (religion_id);


--
-- Name: idx_c6cba95ef5f88db9; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_c6cba95ef5f88db9 ON paciente USING btree (persona_id);


--
-- Name: idx_cb86f22a16a490ec; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_cb86f22a16a490ec ON servicio USING btree (especialidad_id);


--
-- Name: idx_cfd67cdb7cac4034; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_cfd67cdb7cac4034 ON familiar USING btree (parentesco);


--
-- Name: idx_d9c36c147310dad4; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_d9c36c147310dad4 ON paciente_direccion USING btree (paciente_id);


--
-- Name: idx_d9c36c14d0a7bd7; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_d9c36c14d0a7bd7 ON paciente_direccion USING btree (direccion_id);


--
-- Name: idx_de2d5957310dad4; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_de2d5957310dad4 ON representante USING btree (paciente_id);


--
-- Name: idx_f384be9574afdc17; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_f384be9574afdc17 ON direccion USING btree (parroquia_id);


--
-- Name: idx_f82e1f7d2bb32e08; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_f82e1f7d2bb32e08 ON esperando USING btree (profesional);


--
-- Name: idx_f82e1f7d34e5914c; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_f82e1f7d34e5914c ON esperando USING btree (medico);


--
-- Name: idx_f82e1f7d7310dad4; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_f82e1f7d7310dad4 ON esperando USING btree (paciente_id);


--
-- Name: idx_f82e1f7dacb064f9; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_f82e1f7dacb064f9 ON esperando USING btree (especialidad);


--
-- Name: idx_fe98f5e09f5a440b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_fe98f5e09f5a440b ON municipio USING btree (estado_id);


--
-- Name: uniq_4b019ddb5e237e06; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_4b019ddb5e237e06 ON fos_group USING btree (name);


--
-- Name: uniq_957a647992fc23a8; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_957a647992fc23a8 ON fos_user USING btree (username_canonical);


--
-- Name: uniq_957a6479a0d96fbf; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_957a6479a0d96fbf ON fos_user USING btree (email_canonical);


--
-- Name: uniq_957a6479c05fb297; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_957a6479c05fb297 ON fos_user USING btree (confirmation_token);


--
-- Name: fk_142f08677310dad4; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY perinatal
    ADD CONSTRAINT fk_142f08677310dad4 FOREIGN KEY (paciente_id) REFERENCES paciente(id);


--
-- Name: fk_17fb1f757310dad4; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY patologia
    ADD CONSTRAINT fk_17fb1f757310dad4 FOREIGN KEY (paciente_id) REFERENCES paciente(id);


--
-- Name: fk_23a7166858bc1be0; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parroquia
    ADD CONSTRAINT fk_23a7166858bc1be0 FOREIGN KEY (municipio_id) REFERENCES municipio(id);


--
-- Name: fk_23bcdfc37da9b47f; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY disponible
    ADD CONSTRAINT fk_23bcdfc37da9b47f FOREIGN KEY (profesional_especialidad_id) REFERENCES profesional_especialidad(id);


--
-- Name: fk_265de1e3c604d5c6; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estado
    ADD CONSTRAINT fk_265de1e3c604d5c6 FOREIGN KEY (pais_id) REFERENCES pais(id);


--
-- Name: fk_2bb32e08f5f88db9; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY profesional
    ADD CONSTRAINT fk_2bb32e08f5f88db9 FOREIGN KEY (persona_id) REFERENCES persona(id);


--
-- Name: fk_2c3c3d7e16a490ec; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY profesional_especialidad
    ADD CONSTRAINT fk_2c3c3d7e16a490ec FOREIGN KEY (especialidad_id) REFERENCES especialidad(id);


--
-- Name: fk_2c3c3d7e313d7fb9; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY profesional_especialidad
    ADD CONSTRAINT fk_2c3c3d7e313d7fb9 FOREIGN KEY (profesional_id) REFERENCES profesional(id);


--
-- Name: fk_3e379a6216a490ec; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cita
    ADD CONSTRAINT fk_3e379a6216a490ec FOREIGN KEY (especialidad_id) REFERENCES especialidad(id);


--
-- Name: fk_3e379a62313d7fb9; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cita
    ADD CONSTRAINT fk_3e379a62313d7fb9 FOREIGN KEY (profesional_id) REFERENCES profesional(id);


--
-- Name: fk_3e379a627310dad4; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cita
    ADD CONSTRAINT fk_3e379a627310dad4 FOREIGN KEY (paciente_id) REFERENCES paciente(id);


--
-- Name: fk_3e379a62e38d288b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cita
    ADD CONSTRAINT fk_3e379a62e38d288b FOREIGN KEY (consulta_id) REFERENCES consulta(id);


--
-- Name: fk_82dad52e7310dad4; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sicobiologico
    ADD CONSTRAINT fk_82dad52e7310dad4 FOREIGN KEY (paciente_id) REFERENCES paciente(id);


--
-- Name: fk_872e9511313d7fb9; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY servicio_profesional
    ADD CONSTRAINT fk_872e9511313d7fb9 FOREIGN KEY (profesional_id) REFERENCES profesional(id);


--
-- Name: fk_872e951171caa3e7; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY servicio_profesional
    ADD CONSTRAINT fk_872e951171caa3e7 FOREIGN KEY (servicio_id) REFERENCES servicio(id);


--
-- Name: fk_894685ce7310dad4; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sexualidad
    ADD CONSTRAINT fk_894685ce7310dad4 FOREIGN KEY (paciente_id) REFERENCES paciente(id);


--
-- Name: fk_957a6479f5f88db9; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY fos_user
    ADD CONSTRAINT fk_957a6479f5f88db9 FOREIGN KEY (persona_id) REFERENCES persona(id);


--
-- Name: fk_a2cddfa510c20d71; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_familiar
    ADD CONSTRAINT fk_a2cddfa510c20d71 FOREIGN KEY (familiar_id) REFERENCES familiar(id);


--
-- Name: fk_a2cddfa57310dad4; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_familiar
    ADD CONSTRAINT fk_a2cddfa57310dad4 FOREIGN KEY (paciente_id) REFERENCES paciente(id);


--
-- Name: fk_b3c77447a76ed395; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fk_b3c77447a76ed395 FOREIGN KEY (user_id) REFERENCES fos_user(id);


--
-- Name: fk_b3c77447fe54d947; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fk_b3c77447fe54d947 FOREIGN KEY (group_id) REFERENCES fos_group(id);


--
-- Name: fk_c24a09bc7310dad4; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY antecendente
    ADD CONSTRAINT fk_c24a09bc7310dad4 FOREIGN KEY (paciente_id) REFERENCES paciente(id);


--
-- Name: fk_c6cba95e594872dc; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente
    ADD CONSTRAINT fk_c6cba95e594872dc FOREIGN KEY (etnia_id) REFERENCES etnia(id);


--
-- Name: fk_c6cba95e9363fd17; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente
    ADD CONSTRAINT fk_c6cba95e9363fd17 FOREIGN KEY (pfg_id) REFERENCES pfg(id);


--
-- Name: fk_c6cba95eb7850cbd; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente
    ADD CONSTRAINT fk_c6cba95eb7850cbd FOREIGN KEY (religion_id) REFERENCES religion(id);


--
-- Name: fk_c6cba95ef5f88db9; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente
    ADD CONSTRAINT fk_c6cba95ef5f88db9 FOREIGN KEY (persona_id) REFERENCES persona(id);


--
-- Name: fk_cb86f22a16a490ec; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY servicio
    ADD CONSTRAINT fk_cb86f22a16a490ec FOREIGN KEY (especialidad_id) REFERENCES especialidad(id);


--
-- Name: fk_d9c36c147310dad4; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_direccion
    ADD CONSTRAINT fk_d9c36c147310dad4 FOREIGN KEY (paciente_id) REFERENCES paciente(id);


--
-- Name: fk_d9c36c14d0a7bd7; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_direccion
    ADD CONSTRAINT fk_d9c36c14d0a7bd7 FOREIGN KEY (direccion_id) REFERENCES direccion(id);


--
-- Name: fk_de2d5957310dad4; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY representante
    ADD CONSTRAINT fk_de2d5957310dad4 FOREIGN KEY (paciente_id) REFERENCES paciente(id);


--
-- Name: fk_f384be9574afdc17; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY direccion
    ADD CONSTRAINT fk_f384be9574afdc17 FOREIGN KEY (parroquia_id) REFERENCES parroquia(id);


--
-- Name: fk_f82e1f7d2bb32e08; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY esperando
    ADD CONSTRAINT fk_f82e1f7d2bb32e08 FOREIGN KEY (profesional) REFERENCES profesional(id);


--
-- Name: fk_f82e1f7d34e5914c; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY esperando
    ADD CONSTRAINT fk_f82e1f7d34e5914c FOREIGN KEY (medico) REFERENCES profesional(id);


--
-- Name: fk_f82e1f7d7310dad4; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY esperando
    ADD CONSTRAINT fk_f82e1f7d7310dad4 FOREIGN KEY (paciente_id) REFERENCES paciente(id);


--
-- Name: fk_f82e1f7dacb064f9; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY esperando
    ADD CONSTRAINT fk_f82e1f7dacb064f9 FOREIGN KEY (especialidad) REFERENCES especialidad(id);


--
-- Name: fk_fe98f5e09f5a440b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY municipio
    ADD CONSTRAINT fk_fe98f5e09f5a440b FOREIGN KEY (estado_id) REFERENCES estado(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

