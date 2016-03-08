
CREATE TABLE etat (
    nb_pv integer NOT NULL,
    nb_points integer NOT NULL,
    last_modified_at timestamp without time zone
);

INSERT INTO etat VALUES( 1000, 0 );

CREATE TABLE etat_historique(
    nb_pv integer NOT NULL,
    nb_points integer NOT NULL,
    created_at timestamp without time zone
);

CREATE OR REPLACE FUNCTION store_etat() RETURNS TRIGGER AS $store_etat$
BEGIN
    INSERT INTO etat_historique SELECT nb_pv, nb_points, now() FROM etat;
    NEW.last_modified_at = now();
    RETURN NEW; 
END;
$store_etat$ LANGUAGE plpgsql;

CREATE TRIGGER trig_store_etat
BEFORE UPDATE ON etat
FOR EACH ROW EXECUTE PROCEDURE store_etat();

-- categorie 1 : resurrection
-- categorie 2 : resurrection impossible
CREATE TABLE log_points (
    categorie integer NOT NULL,
    points integer NOT NULL,
    created_at timestamp without time zone
);

CREATE TABLE log_pv (
    categorie integer NOT NULL,
    points integer NOT NULL,
    created_at timestamp without time zone
);

CREATE TABLE attaques_recues(
    attaquant character varying(80),
    categorie integer NOT NULL,
    degats integer NOT NULL,
    created_at timestamp without time zone
);

CREATE TABLE anciennes_attaques_recues(
    attaquant character varying(80),
    categorie integer NOT NULL,
    degats integer NOT NULL,
    created_at timestamp without time zone
);

CREATE TABLE attaques_effectuees(
    cible character varying(80),
    categorie integer NOT NULL,
    degats integer NOT NULL,
    created_at timestamp without time zone
);

CREATE TABLE resurrections(
    success boolean NOT NULL,
    created_at timestamp without time zone
);

CREATE TABLE regenerations(
    created_at timestamp without time zone
);


