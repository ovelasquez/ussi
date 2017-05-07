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
-- Name: afeccione; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE afeccione (
    id integer NOT NULL,
    consulta_id bigint,
    enterica_elemento_id integer,
    diagnostico text NOT NULL,
    tratamiento text NOT NULL
);


ALTER TABLE afeccione OWNER TO postgres;

--
-- Name: afeccione_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE afeccione_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE afeccione_id_seq OWNER TO postgres;

--
-- Name: antecedente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE antecedente (
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
    neurologica boolean NOT NULL,
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
    fecha_actualizacion date,
    fecha_registro date NOT NULL
);


ALTER TABLE antecedente OWNER TO postgres;

--
-- Name: antecedente_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE antecedente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE antecedente_id_seq OWNER TO postgres;

--
-- Name: antecedente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE antecedente_id_seq OWNED BY antecedente.id;


--
-- Name: campania; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE campania (
    id integer NOT NULL,
    nombre character varying(255) DEFAULT NULL::character varying NOT NULL
);


ALTER TABLE campania OWNER TO postgres;

--
-- Name: campania_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE campania_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE campania_id_seq OWNER TO postgres;

--
-- Name: campania_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE campania_id_seq OWNED BY campania.id;


--
-- Name: campania_imagen; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE campania_imagen (
    campania_id integer NOT NULL,
    imagen_id integer NOT NULL
);


ALTER TABLE campania_imagen OWNER TO postgres;

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
    status character varying(255) NOT NULL,
    prioridad character varying(255) NOT NULL
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
    penalizacion integer,
    campania_id integer,
    template_reposo text,
    template_constancia text
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
-- Name: constancia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE constancia (
    id integer NOT NULL,
    observacion text NOT NULL,
    codigo character varying(255) NOT NULL,
    consulta_id bigint
);


ALTER TABLE constancia OWNER TO postgres;

--
-- Name: constancia_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE constancia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE constancia_id_seq OWNER TO postgres;

--
-- Name: consulta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE consulta (
    id bigint NOT NULL,
    paciente_id bigint,
    profesional_id bigint,
    especialidad_id bigint,
    egreso boolean,
    fecha timestamp(0) without time zone NOT NULL
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
-- Name: diente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE diente (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    cuadrante smallint NOT NULL,
    posicion smallint NOT NULL,
    identificador character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE diente OWNER TO postgres;

--
-- Name: diente_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE diente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE diente_id_seq OWNER TO postgres;

--
-- Name: diente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE diente_id_seq OWNED BY diente.id;


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
-- Name: enterica_capitulo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE enterica_capitulo (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL
);


ALTER TABLE enterica_capitulo OWNER TO postgres;

--
-- Name: enterica_capitulo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE enterica_capitulo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE enterica_capitulo_id_seq OWNER TO postgres;

--
-- Name: enterica_capitulo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE enterica_capitulo_id_seq OWNED BY enterica_capitulo.id;


--
-- Name: enterica_elemento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE enterica_elemento (
    id integer NOT NULL,
    codigo character varying(255) NOT NULL,
    nombre text NOT NULL,
    entericagrupo_id integer
);


ALTER TABLE enterica_elemento OWNER TO postgres;

--
-- Name: enterica_elemento_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE enterica_elemento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE enterica_elemento_id_seq OWNER TO postgres;

--
-- Name: enterica_elemento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE enterica_elemento_id_seq OWNED BY enterica_elemento.id;


--
-- Name: enterica_grupo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE enterica_grupo (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    entericacapitulo_id integer
);


ALTER TABLE enterica_grupo OWNER TO postgres;

--
-- Name: enterica_grupo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE enterica_grupo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE enterica_grupo_id_seq OWNER TO postgres;

--
-- Name: enterica_grupo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE enterica_grupo_id_seq OWNED BY enterica_grupo.id;


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
-- Name: evolucion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE evolucion (
    id integer NOT NULL,
    consulta_id bigint,
    objetivo text NOT NULL,
    subjetivo text NOT NULL,
    apreciacion text NOT NULL,
    tratamiento text NOT NULL,
    frecuencia character varying(255) DEFAULT NULL::character varying,
    edad integer
);


ALTER TABLE evolucion OWNER TO postgres;

--
-- Name: evolucion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE evolucion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE evolucion_id_seq OWNER TO postgres;

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
-- Name: historia_odontologica; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE historia_odontologica (
    id integer NOT NULL,
    paciente_id bigint,
    tratamientomedico text NOT NULL,
    medicamentoactual text NOT NULL,
    alergia text NOT NULL,
    ultimavisitaodontologo character varying(255) NOT NULL,
    tratamientoaplicado text NOT NULL,
    dolorboca text NOT NULL,
    sangreencias boolean NOT NULL,
    habitos text NOT NULL,
    presionarterial character varying(255) NOT NULL,
    hepatitis character varying(255) NOT NULL,
    tbc character varying(255) NOT NULL,
    enfermedadrespiratoria character varying(255) NOT NULL,
    enfermedadcardiovascular character varying(255) NOT NULL,
    enfermedadhemorragica character varying(255) NOT NULL,
    enfermedadotra character varying(255) NOT NULL,
    enfermedadfamiliar character varying(255) NOT NULL,
    estaembarazada boolean NOT NULL,
    observaciones text NOT NULL
);


ALTER TABLE historia_odontologica OWNER TO postgres;

--
-- Name: historia_odontologica_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE historia_odontologica_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE historia_odontologica_id_seq OWNER TO postgres;

--
-- Name: historia_odontologica_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE historia_odontologica_id_seq OWNED BY historia_odontologica.id;


--
-- Name: imagen; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE imagen (
    id integer NOT NULL,
    nombre character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE imagen OWNER TO postgres;

--
-- Name: imagen_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE imagen_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE imagen_id_seq OWNER TO postgres;

--
-- Name: imagen_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE imagen_id_seq OWNED BY imagen.id;


--
-- Name: insumo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE insumo (
    id integer NOT NULL,
    tipo_insumo_id integer,
    nombre character varying(255) NOT NULL,
    stock integer NOT NULL,
    disponible integer NOT NULL
);


ALTER TABLE insumo OWNER TO postgres;

--
-- Name: insumo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE insumo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE insumo_id_seq OWNER TO postgres;

--
-- Name: insumo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE insumo_id_seq OWNED BY insumo.id;


--
-- Name: insumo_suministrado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE insumo_suministrado (
    id integer NOT NULL,
    consulta_id bigint,
    usuario_id bigint,
    insumo_id integer,
    cantidad integer NOT NULL,
    fecha timestamp(0) without time zone NOT NULL
);


ALTER TABLE insumo_suministrado OWNER TO postgres;

--
-- Name: insumo_suministrado_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE insumo_suministrado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE insumo_suministrado_id_seq OWNER TO postgres;

--
-- Name: insumo_suministrado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE insumo_suministrado_id_seq OWNED BY insumo_suministrado.id;


--
-- Name: medicamento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE medicamento (
    id integer NOT NULL,
    tipo_medicamento_id integer,
    principio_activo character varying(255) NOT NULL,
    stock integer NOT NULL,
    disponible integer NOT NULL
);


ALTER TABLE medicamento OWNER TO postgres;

--
-- Name: medicamento_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE medicamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE medicamento_id_seq OWNER TO postgres;

--
-- Name: medicamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE medicamento_id_seq OWNED BY medicamento.id;


--
-- Name: medicamento_suministrado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE medicamento_suministrado (
    id integer NOT NULL,
    consulta_id bigint,
    user_id bigint,
    medicamento_id integer,
    cantidad integer NOT NULL,
    via_administracion character varying(255) NOT NULL,
    fecha timestamp(0) without time zone NOT NULL
);


ALTER TABLE medicamento_suministrado OWNER TO postgres;

--
-- Name: medicamento_suministrado_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE medicamento_suministrado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE medicamento_suministrado_id_seq OWNER TO postgres;

--
-- Name: medicamento_suministrado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE medicamento_suministrado_id_seq OWNED BY medicamento_suministrado.id;


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
-- Name: observacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE observacion (
    id integer NOT NULL,
    consulta_id bigint,
    fecha timestamp(0) without time zone NOT NULL,
    tipo character varying(255) NOT NULL,
    descripcion text NOT NULL,
    usuario_id bigint
);


ALTER TABLE observacion OWNER TO postgres;

--
-- Name: observacion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE observacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE observacion_id_seq OWNER TO postgres;

--
-- Name: observacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE observacion_id_seq OWNED BY observacion.id;


--
-- Name: odontograma; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE odontograma (
    id integer NOT NULL,
    diente_id integer,
    consulta_id bigint,
    cavidad_1 integer,
    cavidad_2 integer,
    cavidad_3 integer,
    cavidad_4 integer,
    cavidad_5 integer
);


ALTER TABLE odontograma OWNER TO postgres;

--
-- Name: odontograma_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE odontograma_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE odontograma_id_seq OWNER TO postgres;

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
    fecha_actualizacion date
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
    carnet_perinatal boolean,
    patologia_embarazo boolean,
    patologia_parto boolean,
    patologia_puerperio boolean,
    consultas_prenatales boolean,
    edad_gestacional integer,
    forceps boolean,
    cesarea boolean,
    parto boolean,
    peso_nacer integer,
    talla integer,
    circunferencia integer,
    apagar_min boolean,
    asfixia boolean,
    reanimacion boolean,
    patologias_rn boolean,
    egreso_rn_sano boolean,
    egreso_rn_patologico boolean,
    lactancia_exclusiva boolean,
    lactancia_mixta boolean,
    lactancia_aglactacion boolean,
    madre_fuera_casa integer,
    familia_madre boolean,
    familia_padre boolean,
    familia_hermanos boolean,
    familia_otros boolean,
    fecha_registro date NOT NULL,
    fecha_actualizacion date
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
-- Name: receta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE receta (
    id integer NOT NULL,
    consulta_id bigint,
    observacion text NOT NULL
);


ALTER TABLE receta OWNER TO postgres;

--
-- Name: receta_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE receta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE receta_id_seq OWNER TO postgres;

--
-- Name: receta_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE receta_id_seq OWNED BY receta.id;


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
-- Name: reposo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE reposo (
    id integer NOT NULL,
    observacion text NOT NULL,
    inicio text NOT NULL,
    codigo character varying(255) NOT NULL,
    consulta_id bigint
);


ALTER TABLE reposo OWNER TO postgres;

--
-- Name: reposo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE reposo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reposo_id_seq OWNER TO postgres;

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
    menarquia character varying(255),
    ciclo_menstrual character varying(255),
    pr_sexual character varying(255),
    frecuencia_sexual character varying(255),
    numero_parejas integer,
    dispareunia boolean,
    anticonceptivos boolean,
    menopausia boolean,
    andropausia boolean,
    gesta boolean,
    parto boolean,
    cesarea boolean,
    aborto boolean,
    edad_1er_parto integer,
    fecha_ultimo_parto date,
    curetaje boolean,
    numero_hijos_vivos integer,
    numero_hijos_muertos integer,
    peso_ultimo_hijo integer,
    fecha_actualizacion date,
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
    cigarrillos_dia character varying(255),
    fecha_registro date NOT NULL,
    fecha_actualizacion date
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
-- Name: signos_vitales_suministrados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE signos_vitales_suministrados (
    id integer NOT NULL,
    consulta_id bigint,
    user_id bigint,
    valor character varying(255) NOT NULL,
    nombre character varying(255) NOT NULL,
    fecha timestamp(0) without time zone NOT NULL
);


ALTER TABLE signos_vitales_suministrados OWNER TO postgres;

--
-- Name: signos_vitales_suministrados_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE signos_vitales_suministrados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE signos_vitales_suministrados_id_seq OWNER TO postgres;

--
-- Name: signos_vitales_suministrados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE signos_vitales_suministrados_id_seq OWNED BY signos_vitales_suministrados.id;


--
-- Name: tipos_insumo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tipos_insumo (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL
);


ALTER TABLE tipos_insumo OWNER TO postgres;

--
-- Name: tipos_insumo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipos_insumo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tipos_insumo_id_seq OWNER TO postgres;

--
-- Name: tipos_insumo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tipos_insumo_id_seq OWNED BY tipos_insumo.id;


--
-- Name: tipos_medicamento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tipos_medicamento (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL
);


ALTER TABLE tipos_medicamento OWNER TO postgres;

--
-- Name: tipos_medicamento_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipos_medicamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tipos_medicamento_id_seq OWNER TO postgres;

--
-- Name: tipos_medicamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tipos_medicamento_id_seq OWNED BY tipos_medicamento.id;


--
-- Name: tratamiento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tratamiento (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    color character varying(255) NOT NULL,
    cavidad boolean NOT NULL,
    todo boolean NOT NULL
);


ALTER TABLE tratamiento OWNER TO postgres;

--
-- Name: tratamiento_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tratamiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tratamiento_id_seq OWNER TO postgres;

--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY antecedente ALTER COLUMN id SET DEFAULT nextval('antecedente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY campania ALTER COLUMN id SET DEFAULT nextval('campania_id_seq'::regclass);


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

ALTER TABLE ONLY diente ALTER COLUMN id SET DEFAULT nextval('diente_id_seq'::regclass);


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

ALTER TABLE ONLY enterica_capitulo ALTER COLUMN id SET DEFAULT nextval('enterica_capitulo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY enterica_elemento ALTER COLUMN id SET DEFAULT nextval('enterica_elemento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY enterica_grupo ALTER COLUMN id SET DEFAULT nextval('enterica_grupo_id_seq'::regclass);


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

ALTER TABLE ONLY fos_user ALTER COLUMN id SET DEFAULT nextval('fos_user_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY historia_odontologica ALTER COLUMN id SET DEFAULT nextval('historia_odontologica_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY imagen ALTER COLUMN id SET DEFAULT nextval('imagen_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY insumo ALTER COLUMN id SET DEFAULT nextval('insumo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY insumo_suministrado ALTER COLUMN id SET DEFAULT nextval('insumo_suministrado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY medicamento ALTER COLUMN id SET DEFAULT nextval('medicamento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY medicamento_suministrado ALTER COLUMN id SET DEFAULT nextval('medicamento_suministrado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY municipio ALTER COLUMN id SET DEFAULT nextval('municipio_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY observacion ALTER COLUMN id SET DEFAULT nextval('observacion_id_seq'::regclass);


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

ALTER TABLE ONLY receta ALTER COLUMN id SET DEFAULT nextval('receta_id_seq'::regclass);


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
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY signos_vitales_suministrados ALTER COLUMN id SET DEFAULT nextval('signos_vitales_suministrados_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipos_insumo ALTER COLUMN id SET DEFAULT nextval('tipos_insumo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipos_medicamento ALTER COLUMN id SET DEFAULT nextval('tipos_medicamento_id_seq'::regclass);


--
-- Data for Name: afeccione; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY afeccione (id, consulta_id, enterica_elemento_id, diagnostico, tratamiento) FROM stdin;
1	2	1	<p>Sed <strong>tempus</strong> porta est eu feugiat. In hac habitasse platea dictumst. Mauris pretium lorem id erat varius porta. Sed dapibus sapien eu erat ultrices posuere. Mauris non convallis neque, id suscipit nunc. Ut nec libero tempus, ornare ex nec, venenatis tellus. Mauris id luctus turpis. Morbi efficitur quis sem nec sodales. Mauris euismod magna ut nulla blandit laoreet.</p>	<p><strong>Sed</strong> tempus porta est eu feugiat. In hac habitasse platea dictumst. Mauris pretium lorem id erat varius porta. Sed dapibus sapien eu erat ultrices posuere. Mauris non convallis neque, id suscipit nunc. Ut nec libero tempus, ornare ex nec, venenatis tellus. Mauris id luctus turpis. Morbi efficitur quis sem nec sodales. Mauris euismod magna ut nulla blandit laoreet.</p>
2	4	1	<p>Sed <strong>tempus</strong> porta est eu feugiat. In hac habitasse platea dictumst. Mauris pretium lorem id erat varius porta. Sed dapibus sapien eu erat ultrices posuere. Mauris non convallis neque, id suscipit nunc. Ut nec libero tempus, ornare ex nec, venenatis tellus. Mauris id luctus turpis. Morbi efficitur quis sem nec sodales. Mauris euismod magna ut nulla blandit laoreet.</p>	<p>Sed <strong>tempus</strong> porta est eu feugiat. In hac habitasse platea dictumst. Mauris pretium lorem id erat varius porta. Sed dapibus sapien eu erat ultrices posuere. Mauris non convallis neque, id suscipit nunc. Ut nec libero tempus, ornare ex nec, venenatis tellus. Mauris id luctus turpis. Morbi efficitur quis sem nec sodales. Mauris euismod magna ut nulla blandit laoreet.</p>
3	7	4	<p><em><strong>Sed tempus porta est eu feugiat. In hac habitasse platea dictumst. Mauris pretium lorem id erat varius porta.</strong></em> Sed dapibus sapien eu erat ultrices posuere. Mauris non convallis neque, id suscipit nunc. Ut nec libero tempus, ornare ex nec, venenatis tellus. Mauris id luctus turpis. Morbi efficitur quis sem nec sodales. Mauris euismod magna ut nulla blandit laoreet.</p>	<p><em><strong>Sed tempus porta est eu feugiat. In hac habitasse platea dictumst. Mauris pretium lorem id erat varius porta.</strong></em> Sed dapibus sapien eu erat ultrices posuere. Mauris non convallis neque, id suscipit nunc. Ut nec libero tempus, ornare ex nec, venenatis tellus. Mauris id luctus turpis. Morbi efficitur quis sem nec sodales. Mauris euismod magna ut nulla blandit laoreet.</p>
4	8	3	<p>Sed tempus porta est eu feugiat. In hac habitasse platea dictumst. Mauris pretium lorem id erat varius porta. Sed dapibus sapien eu erat ultrices posuere.</p>	<p>Sed tempus porta est eu feugiat. In hac habitasse platea dictumst. Mauris pretium lorem id erat varius porta. Sed dapibus sapien eu erat ultrices posuere.</p>
5	9	1	<p>Diagn&oacute;stico</p>	<p>Tratamiento</p>
6	6	1	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vel lorem eleifend, fringilla turpis vel, rutrum felis. Vestibulum ac purus ut nisl sodales varius. Ut ex nibh, fringilla sagittis interdum ut, viverra aliquet erat. Morbi a leo est. Morbi risus ipsum, auctor eu pretium non, volutpat non tellus. Donec vitae feugiat tortor, ut ultricies dolor. Maecenas quis libero ut mauris imperdiet posuere et sed nibh.</p>	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vel lorem eleifend, fringilla turpis vel, rutrum felis. Vestibulum ac purus ut nisl sodales varius. Ut ex nibh, fringilla sagittis interdum ut, viverra aliquet erat. Morbi a leo est. Morbi risus ipsum, auctor eu pretium non, volutpat non tellus. Donec vitae feugiat tortor, ut ultricies dolor. Maecenas quis libero ut mauris imperdiet posuere et sed nibh.</p>
7	12	1	<p>&nbsp;dump($profesionalDisponible); die();</p>	<p>&nbsp;dump($profesionalDisponible); die();</p>
8	14	3	<p>Cras mattis fermentum enim, quis suscipit eros bibendum eu. Ut ornare, elit non sagittis pellentesque, urna justo congue metus, sit amet fringilla purus lacus sit amet felis. Vestibulum in congue metus, quis ullamcorper nulla. Nulla maximus neque ligula, id aliquam nisi vestibulum eu. In iaculis semper diam, in rutrum ipsum tincidunt quis. Sed consectetur, lacus vitae fermentum finibus, tortor neque accumsan ipsum, ut commodo urna nisi non lectus. Phasellus sed efficitur nulla. Donec vestibulum lectus ut magna convallis tempor. Nam non viverra diam.</p>	<p>Cras mattis fermentum enim, quis suscipit eros bibendum eu. Ut ornare, elit non sagittis pellentesque, urna justo congue metus, sit amet fringilla purus lacus sit amet felis. Vestibulum in congue metus, quis ullamcorper nulla. Nulla maximus neque ligula, id aliquam nisi vestibulum eu. In iaculis semper diam, in rutrum ipsum tincidunt quis. Sed consectetur, lacus vitae fermentum finibus, tortor neque accumsan ipsum, ut commodo urna nisi non lectus. Phasellus sed efficitur nulla. Donec vestibulum lectus ut magna convallis tempor. Nam non viverra diam.</p>
9	16	4	<p>Cras mattis fermentum enim, quis suscipit eros bibendum eu. Ut ornare, elit non sagittis pellentesque, urna justo congue metus, sit amet fringilla purus lacus sit amet felis. Vestibulum in congue metus, quis ullamcorper nulla. Nulla maximus neque ligula, id aliquam nisi vestibulum eu. In iaculis semper diam, in rutrum ipsum tincidunt quis. Sed consectetur, lacus vitae fermentum finibus, tortor neque accumsan ipsum, ut commodo urna nisi non lectus. Phasellus sed efficitur nulla. Donec vestibulum lectus ut magna convallis tempor. Nam non viverra diam.</p>	<p>Cras mattis fermentum enim, quis suscipit eros bibendum eu. Ut ornare, elit non sagittis pellentesque, urna justo congue metus, sit amet fringilla purus lacus sit amet felis. Vestibulum in congue metus, quis ullamcorper nulla. Nulla maximus neque ligula, id aliquam nisi vestibulum eu. In iaculis semper diam, in rutrum ipsum tincidunt quis. Sed consectetur, lacus vitae fermentum finibus, tortor neque accumsan ipsum, ut commodo urna nisi non lectus. Phasellus sed efficitur nulla. Donec vestibulum lectus ut magna convallis tempor. Nam non viverra diam.</p>
10	17	1	<p>Cras mattis fermentum enim, quis suscipit eros bibendum eu. Ut ornare, elit non sagittis pellentesque, urna justo congue metus, sit amet fringilla purus lacus sit amet felis. Vestibulum in congue metus, quis ullamcorper nulla. Nulla maximus neque ligula, id aliquam nisi vestibulum eu. In iaculis semper diam, in rutrum ipsum tincidunt quis. Sed consectetur, lacus vitae fermentum finibus, tortor neque accumsan ipsum, ut commodo urna nisi non lectus. Phasellus sed efficitur nulla. Donec vestibulum lectus ut magna convallis tempor. Nam non viverra diam.</p>	<p>Cras mattis fermentum enim, quis suscipit eros bibendum eu. Ut ornare, elit non sagittis pellentesque, urna justo congue metus, sit amet fringilla purus lacus sit amet felis. Vestibulum in congue metus, quis ullamcorper nulla. Nulla maximus neque ligula, id aliquam nisi vestibulum eu. In iaculis semper diam, in rutrum ipsum tincidunt quis. Sed consectetur, lacus vitae fermentum finibus, tortor neque accumsan ipsum, ut commodo urna nisi non lectus. Phasellus sed efficitur nulla. Donec vestibulum lectus ut magna convallis tempor. Nam non viverra diam.</p>
12	24	4	<p>Diagn&oacute;stico</p>	<p>Tratamiento</p>
13	33	1	<p>Consulta *</p>	<p>Tratamiento *</p>
14	42	1	<p>Diagn&oacute;stico</p>	<p>Tratamiento</p>
16	43	3	<p>vbnm,</p>	<p>ertyuiop</p>
17	45	4	<p>Diagn&oacute;stico</p>	<p>Tratamiento</p>
19	57	1	<p>Diagn&oacute;stico</p>	<p>Tratamiento</p>
20	58	1	<p>Diagn&oacute;stico</p>	<p>Diagn&oacute;stico</p>
\.


--
-- Name: afeccione_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('afeccione_id_seq', 20, true);


--
-- Data for Name: antecedente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY antecedente (id, paciente_id, alergia, asma, tbc, cardiotopia, hipertension, varices, desnutricion, diabetes, obesidad, gastropatia, neurologica, enfermedad_renal, cancer, alcohol, drogas, sifilis, sida, artritis, otros_padre, otros_madre, otros_hermanos, otros, fecha_actualizacion, fecha_registro) FROM stdin;
6	12	t	t	t	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	\N	2017-05-04
\.


--
-- Name: antecedente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('antecedente_id_seq', 6, true);


--
-- Data for Name: campania; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY campania (id, nombre) FROM stdin;
9	Consejos para dejar de fumar
10	Anticoncepcion
11	Alimentacion
18	Panoramicas
19	xxx
\.


--
-- Name: campania_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('campania_id_seq', 19, true);


--
-- Data for Name: campania_imagen; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY campania_imagen (campania_id, imagen_id) FROM stdin;
18	99
18	100
19	101
19	102
9	43
9	44
9	45
9	46
9	47
9	48
9	49
9	50
9	51
9	52
9	53
10	54
10	55
10	56
10	57
10	58
11	59
11	60
11	61
11	62
11	63
11	64
11	65
11	66
11	67
11	68
11	69
11	70
11	71
11	72
11	73
11	74
11	75
11	76
11	77
11	78
\.


--
-- Data for Name: cita; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cita (id, especialidad_id, consulta_id, profesional_id, paciente_id, fecha, status, prioridad) FROM stdin;
54	4	57	\N	12	2017-05-15	activo	normal
55	9	57	\N	12	2017-05-04	activo	alta
57	3	60	\N	12	2012-01-01	activo	normal
58	1	61	21	28	2012-01-01	activo	normal
59	1	61	2	28	2012-01-01	activo	normal
14	5	8	3	10	2017-04-23	procesada	normal
10	5	4	3	10	2017-04-21	procesada	normal
13	5	7	\N	10	2017-04-24	procesada	normal
16	5	12	22	10	2017-04-22	procesada	normal
20	5	15	3	10	2017-04-22	procesada	emergencia
23	6	17	21	12	2017-04-22	activo	emergencia
28	6	30	21	10	2017-06-01	activo	normal
29	3	33	2	\N	2019-06-07	activo	alta
30	3	33	2	\N	2019-06-07	activo	alta
31	3	33	2	\N	2019-06-07	activo	alta
32	3	33	2	\N	2019-06-07	activo	alta
33	8	33	22	\N	2019-06-03	activo	normal
34	8	33	22	\N	2019-06-03	activo	normal
35	2	33	2	9	2017-05-03	activo	normal
36	2	34	\N	10	2012-01-01	activo	normal
39	7	34	3	10	2017-04-08	activo	normal
43	2	45	\N	10	2012-01-18	activo	normal
44	5	46	\N	9	2012-01-19	activo	normal
46	7	44	\N	10	2012-01-01	activo	normal
41	4	43	\N	12	2012-01-01	activo	normal
50	\N	49	\N	22	2012-01-01	activo	normal
51	1	49	\N	22	2012-01-01	activo	normal
52	1	49	\N	22	2012-01-01	activo	normal
\.


--
-- Name: cita_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cita_id_seq', 59, true);


--
-- Data for Name: configuracion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY configuracion (id, numero_consultas, servicio_actualizado, tiempo_espera, penalizacion, campania_id, template_reposo, template_constancia) FROM stdin;
1	5	2017-05-05	3	3	9	<p>Reposo Por medio de la presente hago constar que el ciudadano <strong><em>Mariana Flores</em></strong>, portador de la C&eacute;dula de Identidad V-15457549, acudi&oacute; a la Unidad de Servicios de Salud Integral (USSI) &quot;Dr. Jes&uacute;s Saturno Canel&oacute;n&quot; por presentar ______________________; por lo que se extiende la presente Costancia M&eacute;dica para los usos que estime conveniente.</p>	<p>Por medio de la presente hago constar que el ciudadano <strong><em>Nombre Paciente</em></strong>&nbsp;portador de la C&eacute;dula de Identidad <em><strong>V-12.345.678,</strong></em> acudi&oacute; a la Unidad de Servicios de Salud Integral (USSI) &quot;Dr. Jes&uacute;s Saturno Canel&oacute;n&quot; por presentar ______________________; por lo que se extiende la presente Costancia M&eacute;dica para los usos que estime conveniente.</p>
\.


--
-- Name: configuracion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('configuracion_id_seq', 1, true);


--
-- Data for Name: constancia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY constancia (id, observacion, codigo, consulta_id) FROM stdin;
1	<p>Por medio de la presente hago constar que el ciudadano <strong><em>Oscar Daniel Vel&aacute;squez,</em></strong> portado de la c&eacute;dula de identidad V- 15.217.394, asisti&oacute; a mi consulta en caracter de acompa&ntilde;ante del <strong><em>Paciente Mariana Mercedes Flores Fernandez</em></strong>, titular de la c&eacute;dula de identidad V- 15.457.549; por lo que se extiende la presente Costancia M&eacute;dica para los usos que estime conveniente.</p>	XYZ-123456	16
3	<p>Por medio de la presente hago constar que el ciudadano Oscar Daniel Vel&aacute;squez, portado de la c&eacute;dula de identidad V- 15.217.394, asisti&oacute; a mi consulta en caracter de acompa&ntilde;ante del Paciente Mariana Mercedes Flores Fernandez, titular de la c&eacute;dula de identidad V- 15.457.549; por lo que se extiende la presente Costancia M&eacute;dica para los usos que estime conveniente.</p>	XYZ-1234560	18
4	<p>orem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ex magna, mattis et urna at, vehicula consequat elit. Donec dictum massa suscipit tincidunt dapibus. Proin imperdiet augue ligula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec a purus et lectus vehicula consectetur. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed et massa eu est varius consequat. Fusce eget vulputate elit. Etiam eu justo sed lorem pellentesque volutpat sed in ante. Nunc rutrum arcu at libero vestibulum fermentum.&nbsp;</p>	58fdee083a050	12
9	<p>Por medio de la presente hago constar que el ciudadano <strong><em>Nombre Paciente</em></strong>&nbsp;portador de la C&eacute;dula de Identidad <em><strong>V-12.345.678,</strong></em> acudi&oacute; a la Unidad de Servicios de Salud Integral (USSI) &quot;Dr. Jes&uacute;s Saturno Canel&oacute;n&quot; por presentar ______________________; por lo que se extiende la presente Costancia M&eacute;dica para los usos que estime conveniente.</p>	59024589ac735	34
10	<p>Por medio de la presente hago constar que el ciudadano <strong><em>Nombre Paciente</em></strong>&nbsp;portador de la C&eacute;dula de Identidad <em><strong>V-12.345.678,</strong></em> acudi&oacute; a la Unidad de Servicios de Salud Integral (USSI) &quot;Dr. Jes&uacute;s Saturno Canel&oacute;n&quot; por presentar ______________________; por lo que se extiende la presente Costancia M&eacute;dica para los usos que estime conveniente.</p>	5903a1659e930	37
11	<p>Por medio de la presente hago constar que el ciudadano <strong><em>Nombre Paciente</em></strong>&nbsp;portador de la C&eacute;dula de Identidad <em><strong>V-12.345.678,</strong></em> acudi&oacute; a la Unidad de Servicios de Salud Integral (USSI) &quot;Dr. Jes&uacute;s Saturno Canel&oacute;n&quot; por presentar ______________________; por lo que se extiende la presente Costancia M&eacute;dica para los usos que estime conveniente.</p>	59093f43e8d88	42
17	<p>Por medio de la presente hago constar que el ciudadano <strong><em>Nombre Paciente</em></strong>&nbsp;portador de la C&eacute;dula de Identidad <em><strong>V-12.345.678,</strong></em> acudi&oacute; a la Unidad de Servicios de Salud Integral (USSI) &quot;Dr. Jes&uacute;s Saturno Canel&oacute;n&quot; por presentar ______________________; por lo que se extiende la presente Costancia M&eacute;dica para los usos que estime conveniente.</p>	590b4a08b4d08	57
\.


--
-- Name: constancia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('constancia_id_seq', 17, true);


--
-- Data for Name: consulta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY consulta (id, paciente_id, profesional_id, especialidad_id, egreso, fecha) FROM stdin;
41	10	21	6	t	2017-05-01 23:28:10
51	10	21	6	t	2017-05-03 13:27:53
5	12	3	5	t	2017-04-21 17:14:12
4	10	3	5	t	2017-04-21 11:49:07
7	10	3	5	t	2017-04-21 19:22:33
8	10	3	5	t	2017-04-21 23:44:04
9	10	3	5	t	2017-04-22 00:19:04
53	10	21	6	t	2017-05-03 23:39:32
45	10	3	5	t	2017-05-03 12:35:00
3	12	21	6	t	2017-04-21 00:07:00
6	12	3	5	t	2017-04-21 19:22:11
12	10	3	5	t	2017-04-22 16:32:39
46	9	22	9	t	2017-05-03 12:38:39
14	10	3	5	t	2017-04-22 17:25:25
15	10	3	5	t	2017-04-22 19:25:28
16	10	3	5	t	2017-04-22 19:49:12
17	12	3	5	t	2017-04-22 20:05:00
18	10	3	5	t	2017-04-23 01:27:00
19	10	3	4	t	2017-04-24 08:12:00
47	19	22	9	t	2017-05-03 13:01:00
44	10	22	9	t	2017-05-03 12:34:00
2	12	3	5	t	2017-04-20 20:52:00
48	19	22	9	t	2017-05-03 13:01:00
50	26	22	9	t	2017-05-03 13:11:00
52	20	22	9	t	2017-05-03 16:15:36
28	10	22	9	t	2017-04-24 20:37:50
25	12	22	9	t	2017-04-24 20:15:22
22	12	3	5	t	2017-04-24 12:15:51
24	18	3	5	t	2017-04-24 17:00:00
30	10	3	5	t	2017-04-25 15:56:48
31	12	3	5	t	2017-04-25 16:02:11
32	10	3	5	t	2017-04-27 09:57:23
34	10	3	5	t	2017-04-27 12:42:04
35	10	3	5	t	2017-04-28 14:02:00
36	10	3	5	t	2017-04-28 14:09:00
37	10	3	5	t	2017-04-28 14:19:00
33	9	3	5	t	2017-04-27 10:12:12
29	10	22	9	t	2017-04-25 15:46:49
55	12	21	6	t	2017-05-04 08:04:49
56	12	21	6	f	2017-05-04 08:16:43
42	12	3	5	t	2017-05-02 20:34:11
43	12	3	5	t	2017-05-02 22:26:08
57	12	3	5	t	2017-05-04 11:23:40
49	22	3	5	t	2017-05-03 13:04:00
54	10	21	6	\N	2017-05-04 07:46:09
59	10	21	6	f	2017-05-04 11:44:21
60	12	22	9	f	2017-05-04 11:55:21
58	28	3	5	t	2017-05-04 11:41:35
61	28	3	5	f	2017-05-04 15:16:29
62	28	21	6	f	2017-05-05 11:42:12
\.


--
-- Name: consulta_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('consulta_id_seq', 62, true);


--
-- Data for Name: diente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY diente (id, nombre, cuadrante, posicion, identificador) FROM stdin;
1	Incisivo central superior derecha	1	11	Permanente
43	Incisivo central inferior izquierda	3	71	Leche
2	Incisivo lateral superior derecha	1	12	Permanente
3	Canino superior derecha	1	13	Permanente
4	Primer premolar superior derecha	1	14	Permanente
5	Segunda premolar superior derecha	1	15	Permanente
6	Primer molar superior derecha	1	16	Permanente
7	Segundo molar superior derecha	1	17	Permanente
8	Tercer molar superior derecha	1	18	Permanente
9	Incisivo central superior izquierda	2	21	Permanente
10	Incisivo lateral superior izquierda	2	22	Permanente
11	Canino superior izquierda	2	23	Permanente
12	Primer premolar superior izquierda	2	24	Permanente
13	Segunda premolar superior izquierda	2	25	Permanente
14	Primer molar superior izquierda	2	26	Permanente
15	Segundo molar superior izquierda	2	27	Permanente
16	Tercer molar superior izquierda	2	28	Permanente
17	Incisivo central inferior izquierda	3	31	Permanente
18	Incisivo lateral inferior izquierda	3	32	Permanente
19	Canino inferior izquierda	3	33	Permanente
20	Primer premolar inferior izquierda	3	34	Permanente
21	Segunda premolar inferior izquierda	3	35	Permanente
22	Primer molar inferior izquierda	3	36	Permanente
23	Segunda molar inferior izquierda	3	37	Permanente
24	Tercer molar inferior izquierda	3	38	Permanente
25	Incisivo central inferior derecha	4	41	Permanente
26	Incisivo lateral inferior derecha	4	42	Permanente
27	Canino inferior derecha	4	43	Permanente
28	Primer premolar inferior derecha	4	44	Permanente
29	Segunda premolar inferior derecha	4	45	Permanente
30	Primer molar inferior derecha	4	46	Permanente
31	Segundo molar inferior derecha	4	47	Permanente
32	Tercer molar inferior derecha	4	48	Permanente
33	Incisivo central superior derecha (Leche)	1	51	Leche
34	Incisivo lateral superior derecha (Leche)	1	52	Leche
35	Canino superior derecha (Leche)	1	53	Leche
36	Primer premolar superior derecha (Leche)	1	54	Leche
37	Segunda premolar superior derecha (Leche)	1	55	Leche
38	Incisivo central superior izquierda	2	61	Leche
39	Incisivo lateral superior izquierda	2	62	Leche
40	Canino superior izquierda	2	63	Leche
41	Primer premolar superior izquierda	2	64	Leche
42	Segunda premolar superior izquierda	2	65	Leche
44	Incisivo lateral inferior izquierda	3	72	Leche
45	Canino inferior izquierda	3	73	Leche
46	Primer premolar inferior izquierda	3	74	Leche
47	Segunda premolar inferior izquierda	3	75	Leche
48	Incisivo central inferior derecha	4	81	Leche
49	Incisivo lateral inferior derecha	4	82	Leche
50	Canino inferior derecha	4	83	Leche
51	Primer premolar inferior derecha	4	84	Leche
52	Segunda premolar inferior derecha	4	85	Leche
\.


--
-- Name: diente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('diente_id_seq', 52, true);


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
-- Data for Name: enterica_capitulo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY enterica_capitulo (id, nombre) FROM stdin;
1	Capitulo I
2	Capitulo II
3	Capitulo III
\.


--
-- Name: enterica_capitulo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('enterica_capitulo_id_seq', 3, true);


--
-- Data for Name: enterica_elemento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY enterica_elemento (id, codigo, nombre, entericagrupo_id) FROM stdin;
1	K23-12	Elemento 1	2
2	Codigo	Nombre	1
3	Codigo	Nombre	3
4	Codigo	Nombre	5
\.


--
-- Name: enterica_elemento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('enterica_elemento_id_seq', 4, true);


--
-- Data for Name: enterica_grupo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY enterica_grupo (id, nombre, entericacapitulo_id) FROM stdin;
2	Grupo 1.2	1
1	Grupo 1.1	1
3	Grupo 2.1	2
4	Grupo 2.2	2
5	Grupo 3.1	3
6	Grupo 3.2	3
\.


--
-- Name: enterica_grupo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('enterica_grupo_id_seq', 6, true);


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
9	Enfermería
10	Odontología Triaje
\.


--
-- Name: especialidad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('especialidad_id_seq', 10, true);


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
122	6	21	10	\N	2017-04-22 19:50:23	abandono	0	\N
90	5	\N	12	3	2017-04-20 20:50:40	atendido	0	\N
74	6	\N	4	\N	2017-04-05 11:36:28	abandono	0	\N
72	6	\N	12	3	2017-04-05 09:33:00	abandono	1	\N
124	6	21	12	\N	2017-04-22 20:05:21	abandono	0	\N
75	3	\N	10	\N	2017-04-06 16:25:15	abandono	0	\N
76	6	\N	10	\N	2017-04-06 16:25:56	abandono	0	\N
77	3	\N	12	\N	2017-04-06 16:29:29	abandono	0	\N
79	6	\N	12	\N	2017-04-06 16:31:43	abandono	0	\N
125	5	\N	10	3	2017-04-23 01:26:54	atendido	0	\N
89	6	\N	12	21	2017-04-20 20:50:18	atendido	2	\N
126	5	\N	12	3	2017-04-23 16:25:41	abandono	1	\N
80	5	\N	10	3	2017-04-08 15:32:42	abandono	3	\N
137	5	\N	9	3	2017-04-27 10:10:00	atendido	0	\N
81	5	\N	12	3	2017-04-08 15:37:00	atendido	1	\N
127	4	\N	10	3	2017-04-24 08:14:00	atendido	1	\N
129	9	\N	12	22	2017-04-24 17:39:18	atendido	0	\N
82	5	\N	12	3	2017-04-11 12:29:27	abandono	2	\N
83	6	\N	10	21	2017-04-11 12:29:58	abandono	2	\N
130	9	\N	10	22	2017-04-24 20:18:47	atendido	0	\N
131	9	\N	10	22	2017-04-24 20:34:16	atendido	1	\N
87	6	\N	10	21	2017-04-13 01:39:31	atendido	1	\N
88	3	\N	12	2	2017-04-17 12:03:48	atendido	0	\N
133	9	\N	10	22	2017-04-25 15:46:06	atendido	1	\N
120	5	3	10	3	2017-04-22 19:48:20	atendido	0	\N
104	5	\N	12	3	2017-04-21 16:48:52	atendido	1	\N
138	5	\N	10	3	2017-04-27 10:59:29	atendido	0	\N
134	5	\N	10	3	2017-04-25 15:55:44	atendido	1	\N
109	5	3	10	3	2017-04-21 19:24:11	atendido	0	\N
135	5	\N	12	3	2017-04-25 16:01:29	atendido	0	\N
105	5	\N	12	3	2017-04-21 17:02:00	atendido	0	\N
110	5	3	10	3	2017-04-21 23:43:41	atendido	0	\N
106	5	\N	10	3	2017-04-21 17:27:45	atendido	1	\N
136	5	\N	10	3	2017-04-27 09:57:09	atendido	0	\N
139	5	\N	12	\N	2017-04-27 11:03:04	abandono	0	\N
114	5	\N	10	3	2017-04-22 16:32:24	atendido	0	\N
143	6	\N	10	21	2017-05-01 23:26:43	atendido	0	\N
115	5	\N	10	3	2017-04-22 17:25:04	atendido	0	\N
141	6	\N	10	21	2017-05-01 23:22:43	atendido	0	\N
121	5	3	10	3	2017-04-22 19:48:58	atendido	0	\N
142	6	\N	10	21	2017-05-01 23:25:10	atendido	0	\N
146	6	\N	10	21	2017-05-03 16:38:18	atendido	0	\N
123	5	\N	12	3	2017-04-22 19:53:16	atendido	1	\N
144	5	\N	12	3	2017-05-02 20:33:00	atendido	0	\N
145	9	\N	9	22	2017-05-03 12:37:31	atendido	0	\N
149	6	\N	18	21	2017-05-04 11:11:43	abandono	1	\N
153	6	\N	10	21	2017-05-05 11:51:27	atendido	0	\N
150	6	\N	10	21	2017-05-04 11:12:22	atendido	0	\N
148	5	\N	12	3	2017-05-04 11:11:13	atendido	2	\N
147	5	\N	10	3	2017-05-04 11:09:39	abandono	3	\N
152	9	\N	12	22	2017-05-04 11:36:00	atendido	0	\N
151	9	\N	10	\N	2017-05-04 11:15:30	abandono	0	\N
\.


--
-- Name: esperando_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('esperando_id_seq', 153, true);


--
-- Data for Name: estado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY estado (id, pais_id, nombre) FROM stdin;
1	1	Distrito Federal
\.


--
-- Name: estado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('estado_id_seq', 2, true);


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

SELECT pg_catalog.setval('etnia_id_seq', 29, true);


--
-- Data for Name: evolucion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY evolucion (id, consulta_id, objetivo, subjetivo, apreciacion, tratamiento, frecuencia, edad) FROM stdin;
24	57	<p>Enfermedad Actual y Hallazgos - (O) Objetivo</p>\r\n\r\n<p><strong>Enfermedad Actual y Hallazgos </strong>- (O) Objetivo</p>\r\n\r\n<p>Enfermedad Actual y Hallazgos - (O) Objetivo</p>\r\n\r\n<ul>\r\n\t<li>Enfermedad Actual y Hallazgos - (O) Objetivo</li>\r\n\t<li>Enfermedad Actual y Hallazgos - (O) Objetivo</li>\r\n</ul>	<p>Motivo de la Consulta - (S) Subjetivo&nbsp;</p>\r\n\r\n<p>Cras mattis fermentum enim, quis suscipit eros bibendum eu. Ut ornare, elit non sagittis pellentesque, urna justo congue metus, sit amet fringilla purus lacus sit amet felis. Vestibulum in congue metus, quis ullamcorper nulla. Nulla maximus neque ligula, id aliquam nisi vestibulum eu. In iaculis semper diam, in rutrum ipsum tincidunt quis. Sed consectetur, lacus vitae fermentum finibus, tortor neque accumsan ipsum, ut commodo urna nisi non lectus. Phasellus sed efficitur nulla. Donec vestibulum lectus ut magna convallis tempor. Nam non viverra diam.</p>	<p>Diagn&oacute;stica - (A) Apreciaci&oacute;n</p>	<p>Tratamientos Pendiente - (P) Plan: Tratamiento Educa. Terap. Y Pendiente</p>	primera	26
14	34	<p>Lorem ipsum dolor sit amet, ut per ignota molestie, has prompta invidunt an. Mei tation atomorum salutandi ei, vis ut nostro commodo atomorum, dico eirmod no his. Natum nonumes omittantur an duo, ea aliquam tacimates appellantur nec, et velit suscipit per. Nam in modo esse magna. Tritani oportere est et.</p>\r\n\r\n<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>	<p>Lorem ipsum dolor sit amet, ut per ignota molestie, has prompta invidunt an. Mei tation atomorum salutandi ei, vis ut nostro commodo atomorum, dico eirmod no his. Natum nonumes omittantur an duo, ea aliquam tacimates appellantur nec, et velit suscipit per. Nam in modo esse magna. Tritani oportere est et.</p>\r\n\r\n<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>	<p>Lorem ipsum dolor sit amet, ut per ignota molestie, has prompta invidunt an. Mei tation atomorum salutandi ei, vis ut nostro commodo atomorum, dico eirmod no his. Natum nonumes omittantur an duo, ea aliquam tacimates appellantur nec, et velit suscipit per. Nam in modo esse magna. Tritani oportere est et.</p>\r\n\r\n<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>	<p>Lorem ipsum dolor sit amet, ut per ignota molestie, has prompta invidunt an. Mei tation atomorum salutandi ei, vis ut nostro commodo atomorum, dico eirmod no his. Natum nonumes omittantur an duo, ea aliquam tacimates appellantur nec, et velit suscipit per. Nam in modo esse magna. Tritani oportere est et.</p>\r\n\r\n<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>	primera	35
15	35	<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, ut per ignota molestie, has prompta invidunt an. Mei tation atomorum salutandi ei, vis ut nostro commodo atomorum, dico eirmod no his. Natum nonumes omittantur an duo, ea aliquam tacimates appellantur nec, et velit suscipit per. Nam in modo esse magna. Tritani oportere est et.</p>\r\n\r\n<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>\r\n\r\n<p>&nbsp;</p>	<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, ut per ignota molestie, has prompta invidunt an. Mei tation atomorum salutandi ei, vis ut nostro commodo atomorum, dico eirmod no his. Natum nonumes omittantur an duo, ea aliquam tacimates appellantur nec, et velit suscipit per. Nam in modo esse magna. Tritani oportere est et.</p>\r\n\r\n<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>	<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, ut per ignota molestie, has prompta invidunt an. Mei tation atomorum salutandi ei, vis ut nostro commodo atomorum, dico eirmod no his. Natum nonumes omittantur an duo, ea aliquam tacimates appellantur nec, et velit suscipit per. Nam in modo esse magna. Tritani oportere est et.</p>\r\n\r\n<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>	<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, ut per ignota molestie, has prompta invidunt an. Mei tation atomorum salutandi ei, vis ut nostro commodo atomorum, dico eirmod no his. Natum nonumes omittantur an duo, ea aliquam tacimates appellantur nec, et velit suscipit per. Nam in modo esse magna. Tritani oportere est et.</p>\r\n\r\n<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>	primera	35
16	36	<p>Lorem ipsum dolor sit amet, ut per ignota molestie, has prompta invidunt an. Mei tation atomorum salutandi ei, vis ut nostro commodo atomorum, dico eirmod no his. Natum nonumes omittantur an duo, ea aliquam tacimates appellantur nec, et velit suscipit per. Nam in modo esse magna. Tritani oportere est et.</p>\r\n\r\n<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>\r\n\r\n<p>Et sed possit civibus voluptaria, at facer vocent vituperatoribus mea. Vitae suavitate nec ei. Accusam deserunt dissentias no cum, qui erant utamur at. Ius lorem adipisci ei, per minim appellantur cu. Ad quo eius utinam doming. Has tota liber civibus et, ne congue animal epicurei qui, est id mundi delenit.</p>\r\n\r\n<p>Usu commune qualisque an, propriae deserunt liberavisse quo ei. Ad hinc tation eligendi nam. Esse ocurreret eos et, in eam sensibus adversarium, mea ad putant nonumes perfecto. Ea per honestatis reformidans, ad sed partiendo adolescens.</p>\r\n\r\n<p>Harum officiis eu est, usu utinam persius prompta ne. Nam discere reprehendunt id, duo equidem ceteros principes in, iriure recusabo duo ad. Est ut pertinax disputationi definitionem, at vim vidit mazim apeirian, sint viderer deserunt te qui. Duo ne vero percipit euripidis, per in ignota malorum deleniti, his nobis ancillae postulant id. Odio nostrud sed cu, no facete epicuri euripidis sea, mutat tamquam in his.</p>	<p>Lorem ipsum dolor sit amet, ut per ignota molestie, has prompta invidunt an. Mei tation atomorum salutandi ei, vis ut nostro commodo atomorum, dico eirmod no his. Natum nonumes omittantur an duo, ea aliquam tacimates appellantur nec, et velit suscipit per. Nam in modo esse magna. Tritani oportere est et.</p>\r\n\r\n<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>\r\n\r\n<p>Et sed possit civibus voluptaria, at facer vocent vituperatoribus mea. Vitae suavitate nec ei. Accusam deserunt dissentias no cum, qui erant utamur at. Ius lorem adipisci ei, per minim appellantur cu. Ad quo eius utinam doming. Has tota liber civibus et, ne congue animal epicurei qui, est id mundi delenit.</p>\r\n\r\n<p>Usu commune qualisque an, propriae deserunt liberavisse quo ei. Ad hinc tation eligendi nam. Esse ocurreret eos et, in eam sensibus adversarium, mea ad putant nonumes perfecto. Ea per honestatis reformidans, ad sed partiendo adolescens.</p>\r\n\r\n<p>Harum officiis eu est, usu utinam persius prompta ne. Nam discere reprehendunt id, duo equidem ceteros principes in, iriure recusabo duo ad. Est ut pertinax disputationi definitionem, at vim vidit mazim apeirian, sint viderer deserunt te qui. Duo ne vero percipit euripidis, per in ignota malorum deleniti, his nobis ancillae postulant id. Odio nostrud sed cu, no facete epicuri euripidis sea, mutat tamquam in his.</p>	<p>Lorem ipsum dolor sit amet, ut per ignota molestie, has prompta invidunt an. Mei tation atomorum salutandi ei, vis ut nostro commodo atomorum, dico eirmod no his. Natum nonumes omittantur an duo, ea aliquam tacimates appellantur nec, et velit suscipit per. Nam in modo esse magna. Tritani oportere est et.</p>\r\n\r\n<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>\r\n\r\n<p>Et sed possit civibus voluptaria, at facer vocent vituperatoribus mea. Vitae suavitate nec ei. Accusam deserunt dissentias no cum, qui erant utamur at. Ius lorem adipisci ei, per minim appellantur cu. Ad quo eius utinam doming. Has tota liber civibus et, ne congue animal epicurei qui, est id mundi delenit.</p>\r\n\r\n<p>Usu commune qualisque an, propriae deserunt liberavisse quo ei. Ad hinc tation eligendi nam. Esse ocurreret eos et, in eam sensibus adversarium, mea ad putant nonumes perfecto. Ea per honestatis reformidans, ad sed partiendo adolescens.</p>\r\n\r\n<p>Harum officiis eu est, usu utinam persius prompta ne. Nam discere reprehendunt id, duo equidem ceteros principes in, iriure recusabo duo ad. Est ut pertinax disputationi definitionem, at vim vidit mazim apeirian, sint viderer deserunt te qui. Duo ne vero percipit euripidis, per in ignota malorum deleniti, his nobis ancillae postulant id. Odio nostrud sed cu, no facete epicuri euripidis sea, mutat tamquam in his.</p>	<p>Lorem ipsum dolor sit amet, ut per ignota molestie, has prompta invidunt an. Mei tation atomorum salutandi ei, vis ut nostro commodo atomorum, dico eirmod no his. Natum nonumes omittantur an duo, ea aliquam tacimates appellantur nec, et velit suscipit per. Nam in modo esse magna. Tritani oportere est et.</p>\r\n\r\n<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>\r\n\r\n<p>Et sed possit civibus voluptaria, at facer vocent vituperatoribus mea. Vitae suavitate nec ei. Accusam deserunt dissentias no cum, qui erant utamur at. Ius lorem adipisci ei, per minim appellantur cu. Ad quo eius utinam doming. Has tota liber civibus et, ne congue animal epicurei qui, est id mundi delenit.</p>\r\n\r\n<p>Usu commune qualisque an, propriae deserunt liberavisse quo ei. Ad hinc tation eligendi nam. Esse ocurreret eos et, in eam sensibus adversarium, mea ad putant nonumes perfecto. Ea per honestatis reformidans, ad sed partiendo adolescens.</p>\r\n\r\n<p>Harum officiis eu est, usu utinam persius prompta ne. Nam discere reprehendunt id, duo equidem ceteros principes in, iriure recusabo duo ad. Est ut pertinax disputationi definitionem, at vim vidit mazim apeirian, sint viderer deserunt te qui. Duo ne vero percipit euripidis, per in ignota malorum deleniti, his nobis ancillae postulant id. Odio nostrud sed cu, no facete epicuri euripidis sea, mutat tamquam in his.</p>	primera	35
17	37	<p>Lorem ipsum dolor sit amet, ut per ignota molestie, has prompta invidunt an. Mei tation atomorum salutandi ei, vis ut nostro commodo atomorum, dico eirmod no his. Natum nonumes omittantur an duo, ea aliquam tacimates appellantur nec, et velit suscipit per. Nam in modo esse magna. Tritani oportere est et.</p>\r\n\r\n<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>\r\n\r\n<p>Et sed possit civibus voluptaria, at facer vocent vituperatoribus mea. Vitae suavitate nec ei. Accusam deserunt dissentias no cum, qui erant utamur at. Ius lorem adipisci ei, per minim appellantur cu. Ad quo eius utinam doming. Has tota liber civibus et, ne congue animal epicurei qui, est id mundi delenit.</p>\r\n\r\n<p>Usu commune qualisque an, propriae deserunt liberavisse quo ei. Ad hinc tation eligendi nam. Esse ocurreret eos et, in eam sensibus adversarium, mea ad putant nonumes perfecto. Ea per honestatis reformidans, ad sed partiendo adolescens.</p>	<p>Lorem ipsum dolor sit amet, ut per ignota molestie, has prompta invidunt an. Mei tation atomorum salutandi ei, vis ut nostro commodo atomorum, dico eirmod no his. Natum nonumes omittantur an duo, ea aliquam tacimates appellantur nec, et velit suscipit per. Nam in modo esse magna. Tritani oportere est et.</p>\r\n\r\n<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>\r\n\r\n<p>Et sed possit civibus voluptaria, at facer vocent vituperatoribus mea. Vitae suavitate nec ei. Accusam deserunt dissentias no cum, qui erant utamur at. Ius lorem adipisci ei, per minim appellantur cu. Ad quo eius utinam doming. Has tota liber civibus et, ne congue animal epicurei qui, est id mundi delenit.</p>\r\n\r\n<p>Usu commune qualisque an, propriae deserunt liberavisse quo ei. Ad hinc tation eligendi nam. Esse ocurreret eos et, in eam sensibus adversarium, mea ad putant nonumes perfecto. Ea per honestatis reformidans, ad sed partiendo adolescens.</p>	<p>Lorem ipsum dolor sit amet, ut per ignota molestie, has prompta invidunt an. Mei tation atomorum salutandi ei, vis ut nostro commodo atomorum, dico eirmod no his. Natum nonumes omittantur an duo, ea aliquam tacimates appellantur nec, et velit suscipit per. Nam in modo esse magna. Tritani oportere est et.</p>\r\n\r\n<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>\r\n\r\n<p>Et sed possit civibus voluptaria, at facer vocent vituperatoribus mea. Vitae suavitate nec ei. Accusam deserunt dissentias no cum, qui erant utamur at. Ius lorem adipisci ei, per minim appellantur cu. Ad quo eius utinam doming. Has tota liber civibus et, ne congue animal epicurei qui, est id mundi delenit.</p>\r\n\r\n<p>Usu commune qualisque an, propriae deserunt liberavisse quo ei. Ad hinc tation eligendi nam. Esse ocurreret eos et, in eam sensibus adversarium, mea ad putant nonumes perfecto. Ea per honestatis reformidans, ad sed partiendo adolescens.</p>	<p>Lorem ipsum dolor sit amet, ut per ignota molestie, has prompta invidunt an. Mei tation atomorum salutandi ei, vis ut nostro commodo atomorum, dico eirmod no his. Natum nonumes omittantur an duo, ea aliquam tacimates appellantur nec, et velit suscipit per. Nam in modo esse magna. Tritani oportere est et.</p>\r\n\r\n<p>Has in oblique evertitur. Vero inani paulo vis in, nam eu atqui populo. Sea ludus atomorum theophrastus cu, has meliore lucilius te, eos evertitur philosophia suscipiantur in. Natum audiam assueverit qui eu.</p>\r\n\r\n<p>Et sed possit civibus voluptaria, at facer vocent vituperatoribus mea. Vitae suavitate nec ei. Accusam deserunt dissentias no cum, qui erant utamur at. Ius lorem adipisci ei, per minim appellantur cu. Ad quo eius utinam doming. Has tota liber civibus et, ne congue animal epicurei qui, est id mundi delenit.</p>\r\n\r\n<p>Usu commune qualisque an, propriae deserunt liberavisse quo ei. Ad hinc tation eligendi nam. Esse ocurreret eos et, in eam sensibus adversarium, mea ad putant nonumes perfecto. Ea per honestatis reformidans, ad sed partiendo adolescens.</p>	primera	35
19	42	<p>ratamientos Pendiente - (P) Plan: Tratamiento Educa. Terap. Y Pendiente *</p>\r\n\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n</div>\r\n</div>	<p>ratamientos Pendiente - (P) Plan: Tratamiento Educa. Terap. Y Pendiente *</p>\r\n\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n</div>\r\n</div>	<p>ratamientos Pendiente - (P) Plan: Tratamiento Educa. Terap. Y Pendiente *</p>\r\n\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n</div>\r\n</div>	<p>ratamientos Pendiente - (P) Plan: Tratamiento Educa. Terap. Y Pendiente *</p>\r\n\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n</div>\r\n</div>	primera	26
20	42	<p>&nbsp;la Consulta - (S) Subjetivo *</p>\r\n\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n</div>\r\n</div>	<p>la Consulta - (S) Subjetivo *</p>\r\n\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n</div>\r\n</div>	<div>&nbsp;</div>\r\n\r\n<div>&nbsp;\r\n<div>Consulta *\r\n<div>&nbsp;</div>\r\n</div>\r\n</div>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div>Edad (A&ntilde;os) *\r\n<div>&nbsp;</div>\r\n</div>\r\n\r\n<div>Motivo de la Consulta - (S) Subjetivo *\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div>\r\n<div>&nbsp;</div>\r\n</div>\r\n\r\n<div>Enfermedad Actual y Hallazgos - (O) Objetivo *\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div>\r\n<div>&nbsp;</div>\r\n</div>\r\n\r\n<div>Diagn&oacute;stica</div>\r\n\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n</div>\r\n</div>	<p>atamientos Pendiente</p>	primera	26
\.


--
-- Name: evolucion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('evolucion_id_seq', 24, true);


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
13	padre	JORGE A HERNANDEZ	Procedencia
14	madre	OSCAR D VELASQUEZ	Ocupacion
15	padre	JORGE A HERNANDEZ	Procedencia
16	madre	Waldo Vergara	Ocupacion
12	padre	Centeno	Chef
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
5	47	gmendoza	gmendoza	gmendoza@ussi.ubv.edu.ve	gmendoza@ussi.ubv.edu.ve	t	\N	$2y$13$b9yVVaWylRg7XOia7RV7WerIKhjNddsCr5sqjPvXC4hAkaIuA7xQe	2017-05-04 15:11:15	\N	\N	a:1:{i:0;s:11:"ROLE_MEDICO";}
2	11	bbravo	bbravo	mmarianamff@gmail.com	mmarianamff@gmail.com	t	\N	$2y$13$un74W.HbJH2Es9PDOGC7TORHkprlxFu7Gv1hf4wbRuStDy/b2Igb6	2017-05-04 15:14:25	\N	\N	a:1:{i:0;s:11:"ROLE_MEDICO";}
1	8	admin	admin	velasquez.oscar@gmail.com	velasquez.oscar@gmail.com	t	\N	$2y$13$RfS8Ax50FqjabxPu20FmIOTWuQ5odDDOWvyv1vi03N1suW/DFKaTO	2017-05-04 10:58:35	okOHZsZmu3zmlCj_bJTGamACG3USsVUa5JgX5pXCj3s	2017-04-20 13:07:14	a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}
4	45	aazuaje	aazuaje	aazuaje@ussi.ubv.edu.ve	aazuaje@ussi.ubv.edu.ve	t	\N	$2y$13$uvyuHB4Os/Pc/ZJfXk.7a.4S3ltYkuiH1ItWI070rwd43zTxmBiaW	2017-05-06 15:06:35	\N	\N	a:1:{i:0;s:11:"ROLE_MEDICO";}
33	78	mramos	mramos	mayra@gmail.com	mayra@gmail.com	t	\N	$2y$13$Y8C92Zh0QVSMIc3uAYUIYePnliGrFoEoPiUkUY.j5StF7DalXemlm	2017-04-24 10:18:32	\N	\N	a:1:{i:0;s:14:"ROLE_RECEPCION";}
35	80	qwertyui	qwertyui	cvbnm@gmail.com	cvbnm@gmail.com	t	\N	$2y$13$8.AgSHnphqCaleJUGT0qB.kc4dJh5L36zDA/13nkB7A0sAg9VF5ha	\N	\N	\N	a:1:{i:0;s:11:"ROLE_MEDICO";}
3	46	recepcion	recepcion	marianamff@gmail.com	marianamff@gmail.com	t	\N	$2y$13$pyvN9YuNLPBQyuuimZuBz.u.jBQN1cR3aTeDdr6rs4YYE/JA9S8wS	2017-05-04 14:23:57	ODR-sSHbvfbGLhEzHLSLlzCw3VqDE8SHIYmTIIelc-U	2017-04-23 15:14:50	a:1:{i:0;s:14:"ROLE_RECEPCION";}
36	84	mmarquez	mmarquez	maria.isabel@gmail.com	maria.isabel@gmail.com	t	\N	$2y$13$II01xaQECspEmHNmbOWhfOPN3XO2TzY5EIWvyT5P/1JKkJtLbyR4q	\N	\N	\N	a:1:{i:0;s:11:"ROLE_MEDICO";}
26	69	somostinn	somostinn	oscar.somostinn@gmail.com	oscar.somostinn@gmail.com	t	\N	$2y$13$Iz2o1E.lZfaVNQCZ7mBIHeOVdzQQAl5i0JDDkU0OG6j84V1/huHPu	2017-04-24 03:22:35	\N	\N	a:1:{i:0;s:11:"ROLE_MEDICO";}
28	72	SASAS	sasas	CACA@ggg.com	caca@ggg.com	t	\N	$2y$13$.GzPOfVbbVYEeXiaWELJauG2Bx0PLfZdGHz6DKgRC2yaVU0MiSlLa	\N	\N	\N	a:1:{i:0;s:11:"ROLE_MEDICO";}
29	73	CACAguate	cacaguate	CACAguate@ggg.com	cacaguate@ggg.com	t	\N	$2y$13$CTGaj8FkuXEvcRgHPdNMhuZfbFe..qUhhew8LB8dOIR56gDf/jktK	\N	\N	\N	a:1:{i:0;s:11:"ROLE_MEDICO";}
\.


--
-- Name: fos_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('fos_user_id_seq', 36, true);


--
-- Data for Name: fos_user_user_group; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY fos_user_user_group (user_id, group_id) FROM stdin;
\.


--
-- Data for Name: historia_odontologica; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY historia_odontologica (id, paciente_id, tratamientomedico, medicamentoactual, alergia, ultimavisitaodontologo, tratamientoaplicado, dolorboca, sangreencias, habitos, presionarterial, hepatitis, tbc, enfermedadrespiratoria, enfermedadcardiovascular, enfermedadhemorragica, enfermedadotra, enfermedadfamiliar, estaembarazada, observaciones) FROM stdin;
3	10	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent non lorem vel leo aliquet posuere. Fusce sem risus, sollicitudin laoreet odio et, maximus euismod metus. Praesent tempor, tortor sed tincidunt dapibus, purus arcu finibus justo, sed tincidunt ex nunc ac nunc.	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent non lorem vel leo aliquet posuere. Fusce sem risus, sollicitudin laoreet odio et, maximus euismod metus. Praesent tempor, tortor sed tincidunt dapibus, purus arcu finibus justo, sed tincidunt ex nunc ac nunc.	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent non lorem vel leo aliquet posuere. Fusce sem risus, sollicitudin laoreet odio et, maximus euismod metus. Praesent tempor, tortor sed tincidunt dapibus, purus arcu finibus justo, sed tincidunt ex nunc ac nunc.	1 año	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent non lorem vel leo aliquet posuere. Fusce sem risus, sollicitudin laoreet odio et, maximus euismod metus. Praesent tempor, tortor sed tincidunt dapibus, purus arcu finibus justo, sed tincidunt ex nunc ac nunc.	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent non lorem vel leo aliquet posuere. Fusce sem risus, sollicitudin laoreet odio et, maximus euismod metus. Praesent tempor, tortor sed tincidunt dapibus, purus arcu finibus justo, sed tincidunt ex nunc ac nunc.	t	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent non lorem vel leo aliquet posuere. Fusce sem risus, sollicitudin laoreet odio et, maximus euismod metus. Praesent tempor, tortor sed tincidunt dapibus, purus arcu finibus justo, sed tincidunt ex nunc ac nunc.	100	Lorem ipsum dolor sit amet,	Lorem ipsum dolor sit amet,	Lorem ipsum dolor sit amet,	Lorem ipsum dolor sit amet,	Lorem ipsum dolor sit amet,	Lorem ipsum dolor sit amet,	Lorem ipsum dolor sit amet,	t	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent non lorem vel leo aliquet posuere. Fusce sem risus, sollicitudin laoreet odio et, maximus euismod metus. Praesent tempor, tortor sed tincidunt dapibus, purus arcu finibus justo, sed tincidunt ex nunc ac nunc.
\.


--
-- Name: historia_odontologica_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('historia_odontologica_id_seq', 3, true);


--
-- Data for Name: imagen; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY imagen (id, nombre) FROM stdin;
59	edaa5c4d9476835a0d8ed668b8796b7e.jpeg
60	8e5ddaff0b554a9673bececa45e9c02c.jpeg
61	320c326079b37d5ebc0a70c7461d6fd1.jpeg
62	52813631d1b59b5f2fdd837c73a9d739.jpeg
54	5f576ae8affafe0ea3330a572dd5ca06.jpeg
55	26969b0424cb0cb3330f1d2a87efb751.jpeg
56	1eda02c6a70016a25f06d63b790a4ebf.jpeg
57	894b8e5cc2226e04ae0e90f4f9f67a28.jpeg
58	e55781913226609e656c03f0911ee311.jpeg
63	37c80189daba76520fe7b56cb24908a6.jpeg
64	116fba099ac24a040e100c8b50d0339b.jpeg
65	1bc2099c810f2ce881b2b4b63211a996.jpeg
66	7cc95ba6598604634e543e61a747df47.jpeg
67	861e812b5743b9d8977bc3df6780783a.jpeg
68	bc44d6e845024f5487cddf2d65bec2ed.jpeg
69	8cb79988e7a54e3ed1bf239cad1a0185.jpeg
70	651693f86061eca27c5780c9e85a244e.jpeg
71	2b632f0c28738bcb2499d522c918f41e.jpeg
72	39addb040eeec581ccb2dee099ebfcd8.jpeg
73	e5d759219fa82cfdf4fd8f29075d6b02.jpeg
74	97310db4241d0c49748aeb3f60230832.jpeg
75	e5dce6d1e850dc67c066831f86c37c78.jpeg
76	4c555236370600dc970803089ee13f3f.jpeg
77	4276c2bc6e7830f40f6e620ff4f88bbd.jpeg
78	5c6101065bf341a6b275211b73a3fcfe.jpeg
43	376461c03b9eb73316f41aeb83144d78.jpeg
44	5df3d6767e1bd51d4713a0c3a6070926.jpeg
45	32ae369e3d548e34087f1c68e7256244.jpeg
46	ae771f358c1a01077b7ec011e766b55d.jpeg
47	2e02abf147c033febc37122bcb7e9624.jpeg
48	b4a40ff76bc4d67d873cef824b5e2575.jpeg
49	0f875a362f5e87f7c5126d9e88f1ee2f.jpeg
50	03fa666ffb2bdc70a02c2b6c8b4f16cf.jpeg
51	94e40f1928244b057444767993b9c1b1.jpeg
52	54c3dcf38815931f7cfa9011890e7ee8.jpeg
53	b63b3599a206fe85d9f9206f7cd741ae.jpeg
99	a6906e7ce7202cb4b09bcc17e640b847.png
100	47619a5601313cf1e1974955484fcaa4.png
101	ea338682638f0283548b98aabfa5bf8f.jpeg
102	0170f380c9213f40c1106ceb8e755cd3.jpeg
\.


--
-- Name: imagen_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('imagen_id_seq', 102, true);


--
-- Data for Name: insumo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY insumo (id, tipo_insumo_id, nombre, stock, disponible) FROM stdin;
1	1	insumo1	156	10
2	2	insumo2	123	20
3	3	insumo3	150	15
4	4	insumo4	147	12
5	1	insumo12	10	456
\.


--
-- Name: insumo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('insumo_id_seq', 5, true);


--
-- Data for Name: insumo_suministrado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY insumo_suministrado (id, consulta_id, usuario_id, insumo_id, cantidad, fecha) FROM stdin;
2	5	1	1	100	2012-01-01 00:00:00
3	5	1	1	100	2012-01-01 00:00:00
5	28	5	5	12	2017-04-25 14:08:00
4	28	5	3	10	2017-04-25 13:47:00
6	28	5	4	4	2017-04-25 14:34:00
7	29	5	1	10	2017-04-25 15:50:00
8	52	5	1	2	2017-05-03 17:25:00
\.


--
-- Name: insumo_suministrado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('insumo_suministrado_id_seq', 10, true);


--
-- Data for Name: medicamento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY medicamento (id, tipo_medicamento_id, principio_activo, stock, disponible) FROM stdin;
2	1	Amoxicilina	60	50
\.


--
-- Name: medicamento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('medicamento_id_seq', 2, true);


--
-- Data for Name: medicamento_suministrado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY medicamento_suministrado (id, consulta_id, user_id, medicamento_id, cantidad, via_administracion, fecha) FROM stdin;
2	28	5	2	10	endovenosa	2017-04-25 11:39:00
3	28	5	2	10	endovenosa	2017-04-25 11:39:00
4	28	5	2	12	sublingual	2017-04-25 14:13:00
5	29	5	2	12	endovenosa	2017-04-25 15:49:00
7	52	5	2	4	Oral	2017-05-03 17:25:00
6	44	5	2	10	endovenosa	2017-05-03 15:28:00
9	44	5	2	899	intradérmica	2017-05-03 20:29:00
\.


--
-- Name: medicamento_suministrado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('medicamento_suministrado_id_seq', 9, true);


--
-- Data for Name: municipio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY municipio (id, estado_id, nombre) FROM stdin;
1	1	Libertador
\.


--
-- Name: municipio_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('municipio_id_seq', 2, true);


--
-- Data for Name: observacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY observacion (id, consulta_id, fecha, tipo, descripcion, usuario_id) FROM stdin;
\.


--
-- Name: observacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('observacion_id_seq', 12, true);


--
-- Data for Name: odontograma; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY odontograma (id, diente_id, consulta_id, cavidad_1, cavidad_2, cavidad_3, cavidad_4, cavidad_5) FROM stdin;
117	11	41	2	1	\N	\N	\N
199	28	59	3	3	3	3	3
200	27	59	3	3	3	3	3
201	18	59	8	8	8	8	8
139	51	41	8	8	8	8	8
140	50	41	8	8	8	8	8
141	49	41	8	8	8	8	8
142	48	41	8	8	8	8	8
202	49	59	8	8	8	8	8
203	44	59	1	\N	1	\N	\N
204	3	62	3	3	3	3	3
205	4	62	\N	\N	1	\N	\N
146	4	41	\N	\N	\N	\N	2
207	11	62	\N	\N	\N	\N	1
206	12	62	\N	\N	1	1	\N
208	9	59	\N	\N	\N	\N	11
209	36	59	\N	\N	11	\N	11
147	26	41	7	7	7	7	\N
211	30	59	\N	\N	\N	\N	11
151	22	41	3	3	3	3	3
152	28	41	3	3	3	3	3
210	29	59	\N	11	11	11	\N
156	2	41	2	2	2	2	2
157	1	51	8	8	8	8	8
116	45	41	4	4	4	4	4
159	9	51	8	8	8	8	8
160	33	51	8	8	8	8	8
161	38	51	8	8	8	8	8
162	43	51	8	8	8	8	8
163	48	51	8	8	8	8	8
164	25	51	8	8	8	8	8
165	17	51	8	8	8	8	8
119	24	41	4	4	4	4	4
120	23	41	4	4	4	4	4
122	21	41	8	8	8	8	8
125	18	41	\N	\N	\N	\N	7
126	17	41	\N	\N	\N	\N	7
128	29	41	8	8	8	8	8
129	30	41	8	8	8	8	8
130	27	41	4	4	4	4	4
132	25	41	4	4	4	4	4
133	31	41	\N	\N	\N	\N	7
134	32	41	\N	\N	\N	\N	7
166	8	53	3	3	3	3	3
167	6	53	\N	2	2	\N	2
169	4	55	3	3	3	3	3
170	8	55	3	3	3	3	3
171	12	55	8	8	8	8	8
172	10	55	8	8	8	8	8
176	10	56	\N	\N	\N	\N	2
177	12	56	\N	\N	\N	\N	2
178	15	56	\N	\N	\N	\N	2
175	5	56	\N	\N	1	\N	2
174	7	56	1	\N	\N	\N	2
179	8	56	\N	\N	1	\N	\N
181	6	56	\N	\N	\N	\N	1
182	2	56	\N	\N	1	\N	\N
183	1	56	\N	\N	7	\N	7
184	9	56	\N	\N	7	\N	\N
187	3	59	8	8	8	8	8
189	1	59	\N	\N	11	\N	11
191	37	56	\N	\N	2	\N	2
193	21	56	4	4	4	4	4
194	25	56	4	4	4	4	4
195	32	56	4	4	4	4	4
198	20	59	\N	1	\N	\N	1
\.


--
-- Name: odontograma_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('odontograma_id_seq', 211, true);


--
-- Data for Name: paciente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY paciente (id, religion_id, pfg_id, etnia_id, persona_id, edo_civil, ocupacion, estudio, ano_aprobado, analfabeta, fecha_nacimiento, apellido_familia, cedula_jefe_familia, comunidad, fecha_actualizacion, fecha_registro) FROM stdin;
9	1	\N	19	21	soltero	Empleada	universitaria	5	f	1972-11-01	Vegas	0	administrativo	2017-04-01 20:37:41	2017-03-07 06:53:35
18	1	\N	\N	8	casado	Médico	universitaria	5	f	1969-12-31	Velasquez	4922288	administrativo	2017-04-03 08:40:11	2017-03-29 21:59:22
20	1	\N	\N	46	soltero	Recepcionista	secundaria	5	f	1897-01-01	Recepción	1234567890	administrativo	\N	2017-04-05 09:39:02
19	1	\N	\N	45	soltero	Médico	universitaria	5	f	1969-12-31	Vasquez	4922288	administrativo	2017-04-06 16:12:31	2017-04-01 23:25:34
21	2	\N	\N	47	casado	Médico	otro	5	f	1969-12-31	Mendoza	3456543	administrativo	2017-04-21 12:52:13	2017-04-21 12:39:24
22	1	\N	\N	65	soltero	Profesional	universitaria	5	f	1910-10-10	VERGARA	5678904321	administrativo	\N	2017-04-24 01:23:44
24	1	\N	\N	69	soltero	Profesional	universitaria	5	f	2009-11-06	Velasquez	152173943	administrativo	2017-04-24 03:21:30	2017-04-24 03:18:55
25	1	\N	\N	73	soltero	Profesional	universitaria	5	f	1900-08-23	Flores	2342342	administrativo	2017-04-24 03:39:23	2017-04-24 03:36:14
26	1	\N	\N	76	casado	Profesional	universitaria	5	f	1975-08-08	PEREZ	98765432	administrativo	2017-04-24 08:34:23	2017-04-24 08:33:00
10	1	\N	\N	23	casado	Computación	universitaria	5	f	1982-04-06	Velasquez	15217394	comunidad	2017-04-24 11:38:30	2017-03-21 09:01:39
27	3	\N	\N	81	soltero	Médico	universitaria	6	f	1969-12-31	Apellido	1234567	administrativo	2017-04-24 11:55:17	2017-04-24 11:51:38
28	1	\N	\N	84	soltero	Profesional	universitaria	5	f	2017-06-06	Marquez	32456789	administrativo	\N	2017-04-24 13:06:51
4	3	\N	\N	11	casado	Estudiante	universitaria	5	f	1969-12-31	Bravo	5877494	administrativo	2017-04-24 16:22:32	2017-03-01 10:00:00
12	1	\N	3	25	soltero	Estudiante	universitaria	5	f	1991-02-16	Centeno Medina	10525610	comunidad	2017-05-02 22:23:15	2017-03-23 15:46:38
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

SELECT pg_catalog.setval('paciente_id_seq', 28, true);


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

SELECT pg_catalog.setval('parroquia_id_seq', 2, true);


--
-- Data for Name: patologia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY patologia (id, paciente_id, alergias, asma, neumonia, tbc, cardiotopia, hipertension, dislipidemias, varices, cardopatia_chag, hepatopatia, desnutricion, diabetes, obesidad, gastroenteritis, encoprexis, enfermedad_renal, eunereis, cancer, tromboembolia, tumor_m, meningitis, t_craneoenc, enfermedad_erup, dengue, hospitalizacion, intervencion_quirurgica, accidente, artritis, enfermedad_ts, enfermedad_in_tran, malaria, hansen_leishmar, otros, fecha_registro, fecha_actualizacion) FROM stdin;
2	10	t	t	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	2017-04-24	\N
3	12	t	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	f	2017-05-03	2017-05-03
\.


--
-- Name: patologia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('patologia_id_seq', 3, true);


--
-- Data for Name: perinatal; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY perinatal (id, paciente_id, carnet_perinatal, patologia_embarazo, patologia_parto, patologia_puerperio, consultas_prenatales, edad_gestacional, forceps, cesarea, parto, peso_nacer, talla, circunferencia, apagar_min, asfixia, reanimacion, patologias_rn, egreso_rn_sano, egreso_rn_patologico, lactancia_exclusiva, lactancia_mixta, lactancia_aglactacion, madre_fuera_casa, familia_madre, familia_padre, familia_hermanos, familia_otros, fecha_registro, fecha_actualizacion) FROM stdin;
2	10	t	f	t	f	t	\N	f	f	f	\N	\N	\N	f	f	f	f	f	f	f	f	f	\N	f	f	f	f	2017-04-24	\N
\.


--
-- Name: perinatal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('perinatal_id_seq', 3, true);


--
-- Data for Name: persona; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY persona (id, nacionalidad, cedula, primer_apellido, segundo_apellido, primer_nombre, segundo_nombre, genero, telefono, email, foto, fecha_actualizacion, fecha_registro) FROM stdin;
22	V	963852741	Vergara	Zambrano	Betania	Maria	F	04261234567	profesional@ubv.edu.ve	b0793e7468b63ee2b52c909947042518.jpeg	2017-03-16 13:20:08	2017-03-13 07:44:35
21	V	11064078	Vegas	Rodriguez	Beatriz	Del Carmen	F	04169186948	beatrizdelcarmenvegas@gmail.com	fba897054b978f4ae8ec4486040078e0.jpeg	\N	2017-04-01 20:37:41
46	V	85265478965	Recepción	\N	Sala	\N	F	123456	ovelasquez@ubv.edu.ve	08e18600887ccf8ba71bdb4c6a68d221.jpeg	\N	2017-04-05 09:39:02
8	V	15217394	Velásquez	\N	Oscar	Daniel	M	04262055929	velasquez.oscar@gmail.com	399a4b0783576952e2258094e8111db0.jpeg	2017-04-06 16:07:56	\N
76	V	98765432	PEREZ	\N	Aisker	\N	M	02126543234	centeno365@hotmail.com	e4443144768e918129ad1937b5e2da8a.jpeg	\N	2017-04-24 08:33:00
79	V	1234567890	qwertyuiop	qwertyui	qwertyui	qwertyui	F	12345678	cxdd@gmail.com	1f987fe6ad0d8b86e8066e040925d063.jpeg	\N	\N
70	V	234234234234	Flores	HERNANDEZ	JORGE	Mercedes	F	243242	rrrrwr@ggg.com	user.png	\N	\N
73	V	2342342	Flores	HERNANDEZ	JORGE	Mercedes	M	243242	CACAguate@ggg.com	6091cfd120a18c14ea507c49eea238f4.jpeg	\N	2017-04-24 03:36:14
72	V	2342342342342323	Flores	HERNANDEZ	JORGE	Mercedes	F	243242	CACA@ggg.com	user.png	\N	\N
78	V	11223344	Ramos	Marquez	Mayra	Maria	F	04127654679	mayra@gmail.com	user.png	\N	\N
80	V	3456789567	sdfghjfghj	wertyuiop	ertyuiop34	wertyuioty	F	123456789	cvbnm@gmail.com	faaed051603c91efc2b8b996786828f8.jpeg	\N	2017-04-24 11:01:36
23	V	15457549	Flores	Fernandez	Mariana	Mercedes	F	04264165888	marianamff@gmail.com	fba9e9c083883951ead4121fd1d36591.jpeg	\N	2017-04-24 11:38:30
81	V	12345676	imer Apelli	Apellido	Nombre	\N	F	23213456712	ggss@lljjlj.com	user.png	\N	2017-04-24 11:51:38
69	V	152173943	Velasquez	Flores	Oscar	Alejandro	M	02124340075	oscar.somostinn@gmail.com	67e187147cfc5a24b3a57c15e964cb66.png	\N	\N
65	V	5678904321	VERGARA	VELASQUEZ	VETANIA	MRCEDES	F	04262055929	velasquezoscar800@gmail.com	18a6a7280f2cf4e4c399156a313600d0.jpeg	\N	\N
84	V	32456789	Marquez	Chacon	Maria	Isabel	F	04262055929	maria.isabel@gmail.com	ccd13a18705d5921c2fa8e622a4598bb.jpeg	\N	2017-04-24 13:06:51
11	V	19852039	Bravo	Bracho	Betsabe	Dalilas	F	04263067797	betbravopasantias@gmail.com	63d5a668a902998a8009ee3470dd10f7.jpeg	\N	\N
47	V	12345678	Garcia	Mendoza	Daniel	Alejandro	M	02121236543	alejandra@gmail.com	4654e8f4460e47644697489b2fb12b30.jpeg	\N	2017-04-21 12:39:24
45	V	4922288	Azuaje	Rodrigues	Ana	Maria	F	02722057048	atocha@gmail.com	658b36dcae8893e6e36f7c2351ea333e.jpeg	\N	2017-04-01 23:25:34
25	V	21090578	Centeno	Medina	Virgilio	José	M	04268108575	centeno365.vc@gmail.com	user.png	\N	2017-05-02 22:23:15
\.


--
-- Name: persona_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('persona_id_seq', 84, true);


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
22	47	58754
24	65	123456xyz
26	69	MSSS321
27	70	1123123
28	72	1123123
29	73	1123123
30	76	654345
32	84	1467
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

SELECT pg_catalog.setval('profesional_id_seq', 32, true);


--
-- Data for Name: receta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY receta (id, consulta_id, observacion) FROM stdin;
19	57	<p>Cras mattis fermentum enim, quis suscipit eros bibendum eu. Ut ornare, elit non sagittis pellentesque, urna justo congue metus, sit amet fringilla purus lacus sit amet felis. Vestibulum in congue metus, quis ullamcorper nulla. Nulla maximus neque ligula, id aliquam nisi vestibulum eu. In iaculis semper diam, in rutrum ipsum tincidunt quis. Sed consectetur, lacus vitae fermentum finibus, tortor neque accumsan ipsum, ut commodo urna nisi non lectus. Phasellus sed efficitur nulla. Donec vestibulum lectus ut magna convallis tempor. Nam non viverra diam.</p>
10	34	<p>Indicaciones</p>
11	34	<p>Indicaciones</p>
12	37	<p>Indicacione</p>
14	42	<p>Indicaciones</p>
15	43	<p>dfghjkl</p>
18	53	<p>Indicaciones</p>
\.


--
-- Name: receta_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('receta_id_seq', 19, true);


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
-- Data for Name: reposo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY reposo (id, observacion, inicio, codigo, consulta_id) FROM stdin;
1	<p>Reposo creation</p>	23-04-2017 - 01-05-2017	Codigo	16
3	<p>Reposo creation</p>	23-04-2017 - 30-05-2017	Codigo 1	16
4	<p>Por medio de la presente se indica reposo al ciudadano <strong><em>Oscar Daniel Vel&aacute;squez,</em></strong> portado de la c&eacute;dula de identidad V- 15.217.394, desde hoy por presentar TX Ansiedad generalizada.</p>	23-04-2017 - 28-04-2017	XYZ-123456	16
9	<p><em><strong>Por medio </strong></em>de la presente se indica reposo al ciudadano <strong><em>Oscar Daniel Vel&aacute;squez,</em></strong> portado de la c&eacute;dula de identidad V- 15.217.394, desde hoy por presentar TX Ansiedad generalizada.</p>	23-04-2017 - 23-04-2017	58fc46244a13b	18
13	<p>Descripci&oacute;n del Reposo *</p>	27-04-2017 - 27-04-2017	59022341cb59c	33
14	<p>Reposo Por medio de la presente hago constar que el ciudadano <strong><em>Mariana Flores</em></strong>, portador de la C&eacute;dula de Identidad V-15457549, acudi&oacute; a la Unidad de Servicios de Salud Integral (USSI) &quot;Dr. Jes&uacute;s Saturno Canel&oacute;n&quot; por presentar ______________________; por lo que se extiende la presente Costancia M&eacute;dica para los usos que estime conveniente.</p>	21-04-2017 - 23-05-2017	59024497a8f47	34
15	<p>Reposo Por medio de la presente hago constar que el ciudadano <strong><em>Mariana Flores</em></strong>, portador de la C&eacute;dula de Identidad V-15457549, acudi&oacute; a la Unidad de Servicios de Salud Integral (USSI) &quot;Dr. Jes&uacute;s Saturno Canel&oacute;n&quot; por presentar ______________________; por lo que se extiende la presente Costancia M&eacute;dica para los usos que estime conveniente.</p>	28-04-2017 - 28-04-2017	5903a15d531d2	37
27	<p>Reposo Por medio de la presente hago constar que el ciudadano <strong><em>Mariana Flores</em></strong>, portador de la C&eacute;dula de Identidad V-15457549, acudi&oacute; a la Unidad de Servicios de Salud Integral (USSI) &quot;Dr. Jes&uacute;s Saturno Canel&oacute;n&quot; por presentar ______________________; por lo que se extiende la presente Costancia M&eacute;dica para los usos que estime conveniente.</p>	04-05-2017 - 20-05-2017	590b49a1357f3	57
28	<p>Reposo Por medio de la presente hago constar que el ciudadano <strong><em>Mariana Flores</em></strong>, portador de la C&eacute;dula de Identidad V-15457549, acudi&oacute; a la Unidad de Servicios de Salud Integral (USSI) &quot;Dr. Jes&uacute;s Saturno Canel&oacute;n&quot; por presentar ______________________; por lo que se extiende la presente Costancia M&eacute;dica para los usos que estime conveniente.</p>	04-05-2017 - 04-05-2017	590b7df58f267	58
\.


--
-- Name: reposo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('reposo_id_seq', 28, true);


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
49	9	mixto	Mixto	100	100	2017-04-22	6
41	3	mañana	UBV	10	10	2017-04-23	0
50	9	mixto	Mixto	100	100	2017-04-23	0
54	10	mixto	Mixto	10	10	2017-05-03	3
42	5	mañana	UBV	10	8	2017-04-23	0
51	10	mañana	Mixto	10	10	2017-04-23	0
46	9	mixto	Mixto	100	99	2017-05-03	3
29	6	mixto	UBV	10	9	2017-05-03	3
52	10	mixto	Mixto	10	10	2017-05-01	1
20	3	mañana	Mixto	10	10	2017-05-04	4
32	7	mixto	UBV	10	10	2017-05-01	1
57	10	mixto	Mixto	10	10	2017-04-23	6
58	6	mixto	Mixto	10	10	2017-04-23	0
12	2	mañana	UBV	10	10	2017-05-01	1
7	1	mañana	UBV	10	10	2017-05-01	1
22	4	mañana	UBV	10	10	2017-05-01	1
17	3	mañana	Mixto	10	10	2017-05-01	1
44	9	mixto	Mixto	100	100	2017-05-01	1
2	5	mixto	UBV	10	10	2017-05-01	1
55	10	mixto	Mixto	10	10	2017-05-04	4
35	7	mixto	Comunidad	10	10	2017-05-04	4
11	1	mañana	Comunidad	10	10	2017-05-04	4
25	4	mañana	Comunidad	10	10	2017-05-04	4
27	6	mixto	UBV	10	7	2017-05-01	1
33	7	mixto	Comunidad	10	10	2017-05-02	2
5	5	mixto	Comunidad	10	8	2017-05-04	4
30	6	mixto	Comunidad	10	8	2017-05-04	4
10	1	mañana	Comunidad	10	10	2017-05-02	2
23	4	mañana	Comunidad	10	10	2017-05-02	2
37	3	mixto	UBV	10	10	2017-04-22	6
16	1	mañana	Comunidad	10	10	2017-04-22	6
47	9	mixto	Mixto	100	98	2017-05-04	4
59	1	mañana	UBV	23	23	2017-04-24	0
53	10	mixto	Mixto	10	10	2017-05-02	2
36	7	mixto	UBV	10	10	2017-05-05	5
15	2	mañana	Comunidad	10	10	2017-05-02	2
18	3	mañana	Mixto	10	10	2017-05-02	2
48	9	mixto	Mixto	100	100	2017-05-05	5
21	3	mañana	Mixto	10	10	2017-05-05	5
28	6	mixto	Comunidad	10	10	2017-05-02	2
56	10	mixto	Mixto	10	10	2017-05-05	5
9	1	mañana	UBV	10	10	2017-05-05	5
14	2	mañana	UBV	10	10	2017-05-05	5
26	4	mañana	UBV	10	10	2017-05-05	5
4	5	mixto	UBV	10	10	2017-05-05	5
45	9	mixto	Mixto	100	100	2017-05-02	2
31	6	mixto	UBV	10	9	2017-05-05	5
38	5	mañana	UBV	5	0	2017-04-22	6
43	6	mixto	UBV	10	8	2017-04-22	6
6	5	mixto	Comunidad	10	9	2017-05-02	2
34	7	mixto	UBV	10	10	2017-05-03	3
3	5	mixto	UBV	10	10	2017-05-03	3
8	1	mañana	UBV	10	10	2017-05-03	3
13	2	mañana	UBV	10	10	2017-05-03	3
24	4	mañana	UBV	10	10	2017-05-03	3
19	3	mañana	Mixto	10	10	2017-05-03	3
\.


--
-- Name: servicio_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('servicio_id_seq', 59, true);


--
-- Data for Name: servicio_profesional; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY servicio_profesional (id, servicio_id, profesional_id, status, fecha_actualizacion, observacion) FROM stdin;
10	48	22	activo	\N	\N
11	47	22	activo	\N	\N
12	46	22	activo	\N	\N
13	45	22	activo	\N	\N
14	44	22	activo	2017-04-22 20:51:23	\N
7	43	21	activo	2017-04-22 20:52:38	\N
15	58	21	activo	\N	\N
16	27	21	activo	\N	\N
17	28	21	activo	\N	\N
18	29	21	activo	\N	\N
19	30	21	activo	\N	\N
20	31	21	activo	\N	\N
21	17	26	activo	\N	\N
24	5	3	activo	\N	\N
25	4	3	activo	2017-04-24 11:17:49	\N
26	38	3	activo	\N	\N
27	42	3	activo	\N	\N
3	4	2	activo	2017-04-24 11:27:25	\N
29	12	24	activo	2017-04-24 11:30:20	\N
8	50	22	activo	2017-04-24 15:08:41	\N
9	49	22	activo	2017-04-24 16:23:16	\N
30	2	3	activo	\N	\N
31	6	3	activo	\N	\N
23	3	3	inactivo	2017-05-04 11:02:39	Congreso Salud
\.


--
-- Name: servicio_profesional_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('servicio_profesional_id_seq', 31, true);


--
-- Data for Name: sexualidad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sexualidad (id, paciente_id, menarquia, ciclo_menstrual, pr_sexual, frecuencia_sexual, numero_parejas, dispareunia, anticonceptivos, menopausia, andropausia, gesta, parto, cesarea, aborto, edad_1er_parto, fecha_ultimo_parto, curetaje, numero_hijos_vivos, numero_hijos_muertos, peso_ultimo_hijo, fecha_actualizacion, fecha_registro) FROM stdin;
2	10	\N	\N	\N	\N	0	t	t	f	f	f	f	f	f	\N	\N	f	2	2	2	\N	2017-04-24
\.


--
-- Name: sexualidad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sexualidad_id_seq', 8, true);


--
-- Data for Name: sicobiologico; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sicobiologico (id, paciente_id, alcohol, drogas, isecticidas, deportes, sedentarismo, suenio, chupa_dedo, onicofagia, micciones, evacuaciones, stress, metales_pesados, alimentacion, cigarrillos_dia, fecha_registro, fecha_actualizacion) FROM stdin;
2	10	t	t	t	t	f	f	f	f	f	f	f	f	f	\N	2017-04-21	\N
\.


--
-- Name: sicobiologico_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sicobiologico_id_seq', 4, true);


--
-- Data for Name: signos_vitales_suministrados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY signos_vitales_suministrados (id, consulta_id, user_id, valor, nombre, fecha) FROM stdin;
13	28	5	80	temperatura	2017-04-25 09:35:00
14	28	5	150	frecuencia respiratoria	2017-04-25 09:45:00
15	29	5	100	presion arterial	2017-04-25 15:48:00
16	52	5	34	presion arterial	2017-05-03 17:25:00
19	44	2	145	presion arterial	2017-05-03 21:14:00
\.


--
-- Name: signos_vitales_suministrados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('signos_vitales_suministrados_id_seq', 19, true);


--
-- Data for Name: tipos_insumo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipos_insumo (id, nombre) FROM stdin;
1	Tinsumo1
2	Tinsumo2
3	Tinsumo3
4	Tinsumo4
5	Tinsumo1
\.


--
-- Name: tipos_insumo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipos_insumo_id_seq', 5, true);


--
-- Data for Name: tipos_medicamento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipos_medicamento (id, nombre) FROM stdin;
1	Antibióticos
2	Mucolíticos
4	laxantes
\.


--
-- Name: tipos_medicamento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipos_medicamento_id_seq', 4, true);


--
-- Data for Name: tratamiento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tratamiento (id, nombre, color, cavidad, todo) FROM stdin;
3	Endodoncia	#fa8c0b	f	t
2	Amalgama	rgba(255,16,16,0.87)	t	f
5	Resina	#804000	t	f
6	Implante	#dc13e0	f	t
7	Sellante	#2e870f	t	f
1	Caries	#e6e04c	t	f
8	Corona	#1c31e8	f	t
4	Ausente	rgba(222,40,106,1)	f	t
11	Fuera	#627a63	t	f
12	xxx	#04ffe1	f	t
13	zzz	#9662eb	f	t
14	wwww	#f20c0c	t	f
\.


--
-- Name: tratamiento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tratamiento_id_seq', 14, true);


--
-- Name: afeccione_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY afeccione
    ADD CONSTRAINT afeccione_pkey PRIMARY KEY (id);


--
-- Name: antecedente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY antecedente
    ADD CONSTRAINT antecedente_pkey PRIMARY KEY (id);


--
-- Name: campania_imagen_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY campania_imagen
    ADD CONSTRAINT campania_imagen_pkey PRIMARY KEY (campania_id, imagen_id);


--
-- Name: campania_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY campania
    ADD CONSTRAINT campania_pkey PRIMARY KEY (id);


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
-- Name: constancia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY constancia
    ADD CONSTRAINT constancia_pkey PRIMARY KEY (id);


--
-- Name: consulta_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY consulta
    ADD CONSTRAINT consulta_pkey PRIMARY KEY (id);


--
-- Name: diente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY diente
    ADD CONSTRAINT diente_pkey PRIMARY KEY (id);


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
-- Name: enterica_capitulo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY enterica_capitulo
    ADD CONSTRAINT enterica_capitulo_pkey PRIMARY KEY (id);


--
-- Name: enterica_elemento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY enterica_elemento
    ADD CONSTRAINT enterica_elemento_pkey PRIMARY KEY (id);


--
-- Name: enterica_grupo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY enterica_grupo
    ADD CONSTRAINT enterica_grupo_pkey PRIMARY KEY (id);


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
-- Name: evolucion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evolucion
    ADD CONSTRAINT evolucion_pkey PRIMARY KEY (id);


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
-- Name: historia_odontologica_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY historia_odontologica
    ADD CONSTRAINT historia_odontologica_pkey PRIMARY KEY (id);


--
-- Name: imagen_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY imagen
    ADD CONSTRAINT imagen_pkey PRIMARY KEY (id);


--
-- Name: insumo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY insumo
    ADD CONSTRAINT insumo_pkey PRIMARY KEY (id);


--
-- Name: insumo_suministrado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY insumo_suministrado
    ADD CONSTRAINT insumo_suministrado_pkey PRIMARY KEY (id);


--
-- Name: medicamento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY medicamento
    ADD CONSTRAINT medicamento_pkey PRIMARY KEY (id);


--
-- Name: medicamento_suministrado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY medicamento_suministrado
    ADD CONSTRAINT medicamento_suministrado_pkey PRIMARY KEY (id);


--
-- Name: municipio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY municipio
    ADD CONSTRAINT municipio_pkey PRIMARY KEY (id);


--
-- Name: observacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY observacion
    ADD CONSTRAINT observacion_pkey PRIMARY KEY (id);


--
-- Name: odontograma_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY odontograma
    ADD CONSTRAINT odontograma_pkey PRIMARY KEY (id);


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
-- Name: receta_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY receta
    ADD CONSTRAINT receta_pkey PRIMARY KEY (id);


--
-- Name: religion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY religion
    ADD CONSTRAINT religion_pkey PRIMARY KEY (id);


--
-- Name: reposo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reposo
    ADD CONSTRAINT reposo_pkey PRIMARY KEY (id);


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
-- Name: signos_vitales_suministrados_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY signos_vitales_suministrados
    ADD CONSTRAINT signos_vitales_suministrados_pkey PRIMARY KEY (id);


--
-- Name: tipos_insumo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipos_insumo
    ADD CONSTRAINT tipos_insumo_pkey PRIMARY KEY (id);


--
-- Name: tipos_medicamento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipos_medicamento
    ADD CONSTRAINT tipos_medicamento_pkey PRIMARY KEY (id);


--
-- Name: tratamiento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tratamiento
    ADD CONSTRAINT tratamiento_pkey PRIMARY KEY (id);


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
-- Name: idx_4fdf8de4ce208f97; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_4fdf8de4ce208f97 ON insumo_suministrado USING btree (insumo_id);


--
-- Name: idx_4fdf8de4db38439e; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_4fdf8de4db38439e ON insumo_suministrado USING btree (usuario_id);


--
-- Name: idx_4fdf8de4e38d288b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_4fdf8de4e38d288b ON insumo_suministrado USING btree (consulta_id);


--
-- Name: idx_57518f29e38d288b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_57518f29e38d288b ON reposo USING btree (consulta_id);


--
-- Name: idx_682ccaf1c6f69fb; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_682ccaf1c6f69fb ON configuracion USING btree (campania_id);


--
-- Name: idx_6962840ce38d288b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_6962840ce38d288b ON constancia USING btree (consulta_id);


--
-- Name: idx_77ae56dba76ed395; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_77ae56dba76ed395 ON signos_vitales_suministrados USING btree (user_id);


--
-- Name: idx_77ae56dbe38d288b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_77ae56dbe38d288b ON signos_vitales_suministrados USING btree (consulta_id);


--
-- Name: idx_82dad52e7310dad4; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_82dad52e7310dad4 ON sicobiologico USING btree (paciente_id);


--
-- Name: idx_855e38b67310dad4; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_855e38b67310dad4 ON historia_odontologica USING btree (paciente_id);


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
-- Name: idx_8b8b4c6db38439e; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_8b8b4c6db38439e ON observacion USING btree (usuario_id);


--
-- Name: idx_8b8b4c6e38d288b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_8b8b4c6e38d288b ON observacion USING btree (consulta_id);


--
-- Name: idx_8fc247b5e38d288b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_8fc247b5e38d288b ON evolucion USING btree (consulta_id);


--
-- Name: idx_957a6479f5f88db9; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_957a6479f5f88db9 ON fos_user USING btree (persona_id);


--
-- Name: idx_9e4ee42a1de0b0f3; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_9e4ee42a1de0b0f3 ON odontograma USING btree (cavidad_3);


--
-- Name: idx_9e4ee42a5af82fe2; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_9e4ee42a5af82fe2 ON odontograma USING btree (diente_id);


--
-- Name: idx_9e4ee42a6ae78065; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_9e4ee42a6ae78065 ON odontograma USING btree (cavidad_2);


--
-- Name: idx_9e4ee42a83842550; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_9e4ee42a83842550 ON odontograma USING btree (cavidad_4);


--
-- Name: idx_9e4ee42ae38d288b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_9e4ee42ae38d288b ON odontograma USING btree (consulta_id);


--
-- Name: idx_9e4ee42af3eed1df; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_9e4ee42af3eed1df ON odontograma USING btree (cavidad_1);


--
-- Name: idx_9e4ee42af48315c6; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_9e4ee42af48315c6 ON odontograma USING btree (cavidad_5);


--
-- Name: idx_9ed5faf72c4e30d9; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_9ed5faf72c4e30d9 ON insumo USING btree (tipo_insumo_id);


--
-- Name: idx_a2cddfa510c20d71; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_a2cddfa510c20d71 ON paciente_familiar USING btree (familiar_id);


--
-- Name: idx_a2cddfa57310dad4; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_a2cddfa57310dad4 ON paciente_familiar USING btree (paciente_id);


--
-- Name: idx_a6fe3fde16a490ec; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_a6fe3fde16a490ec ON consulta USING btree (especialidad_id);


--
-- Name: idx_a6fe3fde313d7fb9; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_a6fe3fde313d7fb9 ON consulta USING btree (profesional_id);


--
-- Name: idx_a6fe3fde7310dad4; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_a6fe3fde7310dad4 ON consulta USING btree (paciente_id);


--
-- Name: idx_ad647959763c8aa7; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_ad647959763c8aa7 ON campania_imagen USING btree (imagen_id);


--
-- Name: idx_ad647959c6f69fb; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_ad647959c6f69fb ON campania_imagen USING btree (campania_id);


--
-- Name: idx_b093494ee38d288b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_b093494ee38d288b ON receta USING btree (consulta_id);


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

CREATE INDEX idx_c24a09bc7310dad4 ON antecedente USING btree (paciente_id);


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
-- Name: idx_c999d684521ff07c; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_c999d684521ff07c ON medicamento USING btree (tipo_medicamento_id);


--
-- Name: idx_cb86f22a16a490ec; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_cb86f22a16a490ec ON servicio USING btree (especialidad_id);


--
-- Name: idx_cfd67cdb7cac4034; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_cfd67cdb7cac4034 ON familiar USING btree (parentesco);


--
-- Name: idx_d2401dcea76ed395; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_d2401dcea76ed395 ON medicamento_suministrado USING btree (user_id);


--
-- Name: idx_d2401dcedecc3fdc; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_d2401dcedecc3fdc ON medicamento_suministrado USING btree (medicamento_id);


--
-- Name: idx_d2401dcee38d288b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_d2401dcee38d288b ON medicamento_suministrado USING btree (consulta_id);


--
-- Name: idx_d3fb65657206033f; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_d3fb65657206033f ON enterica_elemento USING btree (entericagrupo_id);


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
-- Name: idx_ed329a23214512a; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_ed329a23214512a ON enterica_grupo USING btree (entericacapitulo_id);


--
-- Name: idx_f1eadc341ab8785e; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_f1eadc341ab8785e ON afeccione USING btree (enterica_elemento_id);


--
-- Name: idx_f1eadc34e38d288b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_f1eadc34e38d288b ON afeccione USING btree (consulta_id);


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
-- Name: uniq_51e5b69b7bf39be0; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_51e5b69b7bf39be0 ON persona USING btree (cedula);


--
-- Name: uniq_51e5b69be7927c74; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_51e5b69be7927c74 ON persona USING btree (email);


--
-- Name: uniq_57518f2920332d99; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_57518f2920332d99 ON reposo USING btree (codigo);


--
-- Name: uniq_6962840c20332d99; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_6962840c20332d99 ON constancia USING btree (codigo);


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
-- Name: fk_4fdf8de4ce208f97; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY insumo_suministrado
    ADD CONSTRAINT fk_4fdf8de4ce208f97 FOREIGN KEY (insumo_id) REFERENCES insumo(id);


--
-- Name: fk_4fdf8de4db38439e; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY insumo_suministrado
    ADD CONSTRAINT fk_4fdf8de4db38439e FOREIGN KEY (usuario_id) REFERENCES fos_user(id);


--
-- Name: fk_4fdf8de4e38d288b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY insumo_suministrado
    ADD CONSTRAINT fk_4fdf8de4e38d288b FOREIGN KEY (consulta_id) REFERENCES consulta(id);


--
-- Name: fk_57518f29e38d288b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reposo
    ADD CONSTRAINT fk_57518f29e38d288b FOREIGN KEY (consulta_id) REFERENCES consulta(id);


--
-- Name: fk_682ccaf1c6f69fb; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY configuracion
    ADD CONSTRAINT fk_682ccaf1c6f69fb FOREIGN KEY (campania_id) REFERENCES campania(id);


--
-- Name: fk_6962840ce38d288b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY constancia
    ADD CONSTRAINT fk_6962840ce38d288b FOREIGN KEY (consulta_id) REFERENCES consulta(id);


--
-- Name: fk_77ae56dba76ed395; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY signos_vitales_suministrados
    ADD CONSTRAINT fk_77ae56dba76ed395 FOREIGN KEY (user_id) REFERENCES fos_user(id);


--
-- Name: fk_77ae56dbe38d288b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY signos_vitales_suministrados
    ADD CONSTRAINT fk_77ae56dbe38d288b FOREIGN KEY (consulta_id) REFERENCES consulta(id) ON DELETE CASCADE;


--
-- Name: fk_82dad52e7310dad4; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sicobiologico
    ADD CONSTRAINT fk_82dad52e7310dad4 FOREIGN KEY (paciente_id) REFERENCES paciente(id);


--
-- Name: fk_855e38b67310dad4; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY historia_odontologica
    ADD CONSTRAINT fk_855e38b67310dad4 FOREIGN KEY (paciente_id) REFERENCES paciente(id);


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
-- Name: fk_8b8b4c6db38439e; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY observacion
    ADD CONSTRAINT fk_8b8b4c6db38439e FOREIGN KEY (usuario_id) REFERENCES fos_user(id);


--
-- Name: fk_8b8b4c6e38d288b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY observacion
    ADD CONSTRAINT fk_8b8b4c6e38d288b FOREIGN KEY (consulta_id) REFERENCES consulta(id) ON DELETE CASCADE;


--
-- Name: fk_8fc247b5e38d288b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evolucion
    ADD CONSTRAINT fk_8fc247b5e38d288b FOREIGN KEY (consulta_id) REFERENCES consulta(id);


--
-- Name: fk_957a6479f5f88db9; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY fos_user
    ADD CONSTRAINT fk_957a6479f5f88db9 FOREIGN KEY (persona_id) REFERENCES persona(id);


--
-- Name: fk_9e4ee42a1de0b0f3; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY odontograma
    ADD CONSTRAINT fk_9e4ee42a1de0b0f3 FOREIGN KEY (cavidad_3) REFERENCES tratamiento(id);


--
-- Name: fk_9e4ee42a5af82fe2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY odontograma
    ADD CONSTRAINT fk_9e4ee42a5af82fe2 FOREIGN KEY (diente_id) REFERENCES diente(id);


--
-- Name: fk_9e4ee42a6ae78065; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY odontograma
    ADD CONSTRAINT fk_9e4ee42a6ae78065 FOREIGN KEY (cavidad_2) REFERENCES tratamiento(id);


--
-- Name: fk_9e4ee42a83842550; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY odontograma
    ADD CONSTRAINT fk_9e4ee42a83842550 FOREIGN KEY (cavidad_4) REFERENCES tratamiento(id);


--
-- Name: fk_9e4ee42ae38d288b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY odontograma
    ADD CONSTRAINT fk_9e4ee42ae38d288b FOREIGN KEY (consulta_id) REFERENCES consulta(id);


--
-- Name: fk_9e4ee42af3eed1df; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY odontograma
    ADD CONSTRAINT fk_9e4ee42af3eed1df FOREIGN KEY (cavidad_1) REFERENCES tratamiento(id);


--
-- Name: fk_9e4ee42af48315c6; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY odontograma
    ADD CONSTRAINT fk_9e4ee42af48315c6 FOREIGN KEY (cavidad_5) REFERENCES tratamiento(id);


--
-- Name: fk_9ed5faf72c4e30d9; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY insumo
    ADD CONSTRAINT fk_9ed5faf72c4e30d9 FOREIGN KEY (tipo_insumo_id) REFERENCES tipos_insumo(id);


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
-- Name: fk_a6fe3fde16a490ec; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY consulta
    ADD CONSTRAINT fk_a6fe3fde16a490ec FOREIGN KEY (especialidad_id) REFERENCES especialidad(id);


--
-- Name: fk_a6fe3fde313d7fb9; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY consulta
    ADD CONSTRAINT fk_a6fe3fde313d7fb9 FOREIGN KEY (profesional_id) REFERENCES profesional(id);


--
-- Name: fk_a6fe3fde7310dad4; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY consulta
    ADD CONSTRAINT fk_a6fe3fde7310dad4 FOREIGN KEY (paciente_id) REFERENCES paciente(id);


--
-- Name: fk_ad647959763c8aa7; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY campania_imagen
    ADD CONSTRAINT fk_ad647959763c8aa7 FOREIGN KEY (imagen_id) REFERENCES imagen(id);


--
-- Name: fk_ad647959c6f69fb; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY campania_imagen
    ADD CONSTRAINT fk_ad647959c6f69fb FOREIGN KEY (campania_id) REFERENCES campania(id);


--
-- Name: fk_b093494ee38d288b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY receta
    ADD CONSTRAINT fk_b093494ee38d288b FOREIGN KEY (consulta_id) REFERENCES consulta(id);


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
-- Name: fk_b65821f37310dad4; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY antecedente
    ADD CONSTRAINT fk_b65821f37310dad4 FOREIGN KEY (paciente_id) REFERENCES paciente(id);


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
-- Name: fk_c999d684521ff07c; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY medicamento
    ADD CONSTRAINT fk_c999d684521ff07c FOREIGN KEY (tipo_medicamento_id) REFERENCES tipos_medicamento(id);


--
-- Name: fk_cb86f22a16a490ec; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY servicio
    ADD CONSTRAINT fk_cb86f22a16a490ec FOREIGN KEY (especialidad_id) REFERENCES especialidad(id);


--
-- Name: fk_d2401dcea76ed395; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY medicamento_suministrado
    ADD CONSTRAINT fk_d2401dcea76ed395 FOREIGN KEY (user_id) REFERENCES fos_user(id);


--
-- Name: fk_d2401dcedecc3fdc; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY medicamento_suministrado
    ADD CONSTRAINT fk_d2401dcedecc3fdc FOREIGN KEY (medicamento_id) REFERENCES medicamento(id);


--
-- Name: fk_d2401dcee38d288b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY medicamento_suministrado
    ADD CONSTRAINT fk_d2401dcee38d288b FOREIGN KEY (consulta_id) REFERENCES consulta(id) ON DELETE CASCADE;


--
-- Name: fk_d3fb65657206033f; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY enterica_elemento
    ADD CONSTRAINT fk_d3fb65657206033f FOREIGN KEY (entericagrupo_id) REFERENCES enterica_grupo(id);


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
-- Name: fk_ed329a23214512a; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY enterica_grupo
    ADD CONSTRAINT fk_ed329a23214512a FOREIGN KEY (entericacapitulo_id) REFERENCES enterica_capitulo(id);


--
-- Name: fk_f1eadc341ab8785e; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY afeccione
    ADD CONSTRAINT fk_f1eadc341ab8785e FOREIGN KEY (enterica_elemento_id) REFERENCES enterica_elemento(id);


--
-- Name: fk_f1eadc34e38d288b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY afeccione
    ADD CONSTRAINT fk_f1eadc34e38d288b FOREIGN KEY (consulta_id) REFERENCES consulta(id);


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

