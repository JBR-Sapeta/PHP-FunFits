PGDMP     /        
    
        {           railway    13.2    14.3 T    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    17471    railway    DATABASE     [   CREATE DATABASE railway WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'en_US.utf8';
    DROP DATABASE railway;
                postgres    false                        3079    16927    timescaledb 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS timescaledb WITH SCHEMA public;
    DROP EXTENSION timescaledb;
                   false            �           0    0    EXTENSION timescaledb    COMMENT     i   COMMENT ON EXTENSION timescaledb IS 'Enables scalable inserts and complex queries for time-series data';
                        false    2            �           1247    17855 
   basestatus    TYPE     Y   CREATE TYPE public.basestatus AS ENUM (
    'Pending',
    'Accepted',
    'Rejected'
);
    DROP TYPE public.basestatus;
       public          postgres    false            �           1247    17838    games    TYPE     e   CREATE TYPE public.games AS ENUM (
    'Football',
    'Voleyball',
    'Basketball',
    'Tenis'
);
    DROP TYPE public.games;
       public          postgres    false            �           1255    17944    acceptgame(integer, integer) 	   PROCEDURE     �  CREATE PROCEDURE public.acceptgame(userid integer, gameid integer)
    LANGUAGE plpgsql
    AS $$
DECLARE
   opponentTeam teams%ROWTYPE;
   gameRow matches%ROWTYPE;
BEGIN
 

   
   SELECT * INTO gameRow FROM matches WHERE id=gameId;
   SELECT * INTO opponentTeam FROM teams WHERE id=gameRow.opponent_id;
      
   IF opponentTeam IS NOT NULL AND opponentTeam.owner_id = userId AND  gameRow IS NOT NULL THEN
      UPDATE matches SET  status = 'Accepted' WHERE id=gameId;
   END IF;

   COMMIT;
END;$$;
 B   DROP PROCEDURE public.acceptgame(userid integer, gameid integer);
       public          postgres    false            �           1255    17896 "   acceptinvitation(integer, integer) 	   PROCEDURE     p  CREATE PROCEDURE public.acceptinvitation(invid integer, userid integer)
    LANGUAGE plpgsql
    AS $$
DECLARE
   invitation invitations%ROWTYPE;
   team teams%ROWTYPE;
BEGIN
   
   SELECT * INTO invitation FROM invitations WHERE id=invId;
   SELECT * INTO team FROM teams WHERE teams.id = invitation.team_id;

   IF invitation IS NOT NULL AND team IS NOT NULL AND team.owner_id=userId THEN
         UPDATE invitations SET  status = 'Accepted' WHERE id=invId;
         UPDATE teams SET members=members + 1  WHERE id=team.id;
         INSERT INTO users_teams (user_id, team_id) VALUES (userId, team.id);
   END IF;


END;$$;
 G   DROP PROCEDURE public.acceptinvitation(invid integer, userid integer);
       public          postgres    false            �           1255    17812 A   add_user(character varying, character varying, character varying)    FUNCTION     �  CREATE FUNCTION public.add_user(email character varying, username character varying, pass character varying) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
   u_details_id integer;
   user_id integer;
BEGIN
  
   INSERT INTO users_details("name",surname )
   VALUES ('User', 'Anonymous')
   RETURNING id INTO u_details_id;

  
   INSERT INTO users(user_details_id,email,username,"password") 
   VALUES (u_details_id, email, username, pass)
   RETURNING id INTO user_id;

	
   RETURN user_id;
END;
$$;
 l   DROP FUNCTION public.add_user(email character varying, username character varying, pass character varying);
       public          postgres    false            �           1255    17932 A   creategame(integer, integer, integer, character varying, integer) 	   PROCEDURE     �  CREATE PROCEDURE public.creategame(userid integer, hostid integer, opponentid integer, place character varying, game_date integer)
    LANGUAGE plpgsql
    AS $$
DECLARE
   hostTeam teams%ROWTYPE;
   opponentTeam teams%ROWTYPE;
BEGIN
 

   SELECT * INTO hostTeam FROM teams WHERE teams.id=hostId;
   SELECT * INTO opponentTeam FROM teams WHERE teams.id=opponentId;

   IF hostTeam IS NOT NULL AND hostTeam.owner_id = userId AND  opponentTeam IS NOT NULL  AND hostTeam.id != opponentTeam.id AND hostTeam.game = opponentTeam.game   THEN
   INSERT INTO matches (host_id, opponent_id, place, date) VALUES (hostId, opponentId, place, game_date::timestamp );
   END IF;

   COMMIT;
END;$$;
 �   DROP PROCEDURE public.creategame(userid integer, hostid integer, opponentid integer, place character varying, game_date integer);
       public          postgres    false            �           1255    17931 K   creategame(integer, integer, integer, character varying, character varying) 	   PROCEDURE     �  CREATE PROCEDURE public.creategame(userid integer, hostid integer, opponentid integer, place character varying, game_date character varying)
    LANGUAGE plpgsql
    AS $$
DECLARE
   hostTeam teams%ROWTYPE;
   opponentTeam teams%ROWTYPE;
BEGIN
 

   SELECT * INTO hostTeam FROM teams WHERE teams.id=hostId;
   SELECT * INTO opponentTeam FROM teams WHERE teams.id=opponentId;

   IF hostTeam IS NOT NULL AND hostTeam.owner_id = userId AND  opponentTeam IS NOT NULL  AND hostTeam.id != opponentTeam.id AND hostTeam.game = opponentTeam.game   THEN
   INSERT INTO matches (host_id, opponent_id, place, date) VALUES (hostId, opponentId, place, game_date::timestamp );
   END IF;

   COMMIT;
END;$$;
 �   DROP PROCEDURE public.creategame(userid integer, hostid integer, opponentid integer, place character varying, game_date character varying);
       public          postgres    false            �           1255    17872 "   createinvitation(integer, integer) 	   PROCEDURE     j  CREATE PROCEDURE public.createinvitation(userid integer, teamid integer)
    LANGUAGE plpgsql
    AS $$
DECLARE
   invitation invitations%ROWTYPE;
   team teams%ROWTYPE;
   user_team users_teams%ROWTYPE;
BEGIN
 
   SELECT * INTO invitation FROM invitations WHERE team_id=teamId AND  user_id=userId;
   SELECT * INTO team FROM teams WHERE id=teamId;
   SELECT * INTO user_team FROM users_teams WHERE team_id=teamId AND user_id=userId;

   IF invitation IS NULL AND team.owner_id != userId AND  user_team IS NULL THEN
   INSERT INTO invitations (user_id, team_id) VALUES (userId, teamId);
   END IF;

   COMMIT;
END;$$;
 H   DROP PROCEDURE public.createinvitation(userid integer, teamid integer);
       public          postgres    false            �           1255    17852    delete_team(integer, integer)    FUNCTION     u  CREATE FUNCTION public.delete_team(teamid integer, userid integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
   team teams%ROWTYPE;
   isDeleted BOOLEAN;
BEGIN

   SElECT * INTO team FROM teams WHERE id=teamId;

   IF team.owner_id = userId THEN
   DELETE FROM teams where id = teamId;
   ELSE
   isDeleted = false;
   END IF;

	
   RETURN isDeleted;
END;
$$;
 B   DROP FUNCTION public.delete_team(teamid integer, userid integer);
       public          postgres    false            �           1255    17933    deletegame(integer, integer) 	   PROCEDURE     �  CREATE PROCEDURE public.deletegame(userid integer, gameid integer)
    LANGUAGE plpgsql
    AS $$
DECLARE
   hostTeam teams%ROWTYPE;
   gameRow matches%ROWTYPE;
BEGIN
 

   
   SELECT * INTO gameRow FROM matches WHERE id=gameId;
   SELECT * INTO hostTeam FROM teams WHERE id=gameRow.host_id;

   IF hostTeam IS NOT NULL AND hostTeam.owner_id = userId AND  gameRow IS NOT NULL THEN
   DELETE FROM matches WHERE id=gameId;
   END IF;

   COMMIT;
END;$$;
 B   DROP PROCEDURE public.deletegame(userid integer, gameid integer);
       public          postgres    false            �           1255    17895 "   deleteinvitation(integer, integer) 	   PROCEDURE     y  CREATE PROCEDURE public.deleteinvitation(invid integer, userid integer)
    LANGUAGE plpgsql
    AS $$
DECLARE
   invitation invitations%ROWTYPE;
BEGIN
 
   SELECT * INTO invitation FROM invitations WHERE id=invId AND  user_id=userId;

   IF invitation IS NOT NULL AND invitation.user_id = userId  THEN
   DELETE FROM invitations WHERE id=invId;
   END IF;

   COMMIT;
END;$$;
 G   DROP PROCEDURE public.deleteinvitation(invid integer, userid integer);
       public          postgres    false            �           1255    17945    rejectgame(integer, integer) 	   PROCEDURE     �  CREATE PROCEDURE public.rejectgame(userid integer, gameid integer)
    LANGUAGE plpgsql
    AS $$
DECLARE
   opponentTeam teams%ROWTYPE;
   gameRow matches%ROWTYPE;
BEGIN
 
   SELECT * INTO gameRow FROM matches WHERE id=gameId;
   SELECT * INTO opponentTeam FROM teams WHERE id=gameRow.opponent_id;
      
   IF opponentTeam IS NOT NULL AND opponentTeam.owner_id = userId AND  gameRow IS NOT NULL THEN
      UPDATE matches SET  status = 'Rejected' WHERE id=gameId;
   END IF;

   COMMIT;
END;$$;
 B   DROP PROCEDURE public.rejectgame(userid integer, gameid integer);
       public          postgres    false            �           1255    17897 "   rejectinvitation(integer, integer) 	   PROCEDURE     �  CREATE PROCEDURE public.rejectinvitation(invid integer, userid integer)
    LANGUAGE plpgsql
    AS $$
DECLARE
   invitation invitations%ROWTYPE;
   team teams%ROWTYPE;
BEGIN
 
   SELECT * INTO invitation FROM invitations WHERE id=invId;
   SELECT * INTO team FROM teams WHERE teams.id = invitation.team_id;

   IF invitation IS NOT NULL AND team IS NOT NULL AND team.owner_id=userId THEN
   UPDATE invitations SET  status = 'Rejected' WHERE id=invId;
   END IF;

   COMMIT;
END;$$;
 G   DROP PROCEDURE public.rejectinvitation(invid integer, userid integer);
       public          postgres    false            �            1259    17866    invitations    TABLE     �   CREATE TABLE public.invitations (
    id integer NOT NULL,
    user_id integer NOT NULL,
    team_id integer NOT NULL,
    status public.basestatus DEFAULT 'Pending'::public.basestatus NOT NULL,
    created_at date DEFAULT CURRENT_DATE NOT NULL
);
    DROP TABLE public.invitations;
       public         heap    postgres    false    993    993            �            1259    17873    invitations_id_seq    SEQUENCE     �   ALTER TABLE public.invitations ALTER COLUMN id ADD GENERATED BY DEFAULT AS IDENTITY (
    SEQUENCE NAME public.invitations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483646
    CACHE 1
);
            public          postgres    false    252                        1259    17911    matches    TABLE       CREATE TABLE public.matches (
    id integer NOT NULL,
    host_id integer NOT NULL,
    opponent_id integer NOT NULL,
    place character varying(64) NOT NULL,
    date timestamp with time zone NOT NULL,
    status public.basestatus DEFAULT 'Pending'::public.basestatus NOT NULL
);
    DROP TABLE public.matches;
       public         heap    postgres    false    993    993                       1259    17917    matches_id_seq    SEQUENCE     �   ALTER TABLE public.matches ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.matches_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483646
    CACHE 1
);
            public          postgres    false    256            �            1259    17608    teams    TABLE     ]  CREATE TABLE public.teams (
    id integer NOT NULL,
    owner_id integer,
    title character varying(128) NOT NULL,
    city character varying(32) NOT NULL,
    description character varying(512) NOT NULL,
    image character varying(256) NOT NULL,
    game public.games DEFAULT 'Football'::public.games NOT NULL,
    members integer DEFAULT 1
);
    DROP TABLE public.teams;
       public         heap    postgres    false    990    990            �            1259    17796    teams_id_seq    SEQUENCE     �   ALTER TABLE public.teams ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.teams_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 999999999
    CACHE 1
);
            public          postgres    false    248            �            1259    17592    users    TABLE        CREATE TABLE public.users (
    id integer NOT NULL,
    email character varying(128) NOT NULL,
    username character varying(64) NOT NULL,
    password character varying(256) NOT NULL,
    name character varying(32) DEFAULT 'User'::character varying NOT NULL,
    surname character varying(32) DEFAULT 'Anonymous'::character varying NOT NULL,
    avatar character varying(256) DEFAULT 'default_avatar.png'::character varying NOT NULL,
    phone character varying(12) DEFAULT '-'::character varying NOT NULL
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    17794    users_id_seq    SEQUENCE     �   ALTER TABLE public.users ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 99999999
    CACHE 1
);
            public          postgres    false    247            �            1259    17616    users_teams    TABLE     `   CREATE TABLE public.users_teams (
    user_id integer NOT NULL,
    team_id integer NOT NULL
);
    DROP TABLE public.users_teams;
       public         heap    postgres    false                       1259    17969    v_games_teams    VIEW     �  CREATE VIEW public.v_games_teams AS
 SELECT host.title AS host_title,
    host.owner_id AS host_owner,
    matches.host_id,
    matches.id,
    matches.place,
    matches.date,
    matches.status,
    opponent.title AS opponent_title,
    opponent.owner_id AS opponent_owner,
    matches.opponent_id
   FROM ((public.matches
     LEFT JOIN public.teams host ON ((host.id = matches.host_id)))
     RIGHT JOIN public.teams opponent ON ((opponent.id = matches.opponent_id)));
     DROP VIEW public.v_games_teams;
       public          postgres    false    256    256    256    256    248    248    248    256    256    993            �            1259    17898    v_teams_invitations    VIEW     p  CREATE VIEW public.v_teams_invitations AS
 SELECT invitations.id,
    invitations.user_id,
    invitations.team_id,
    invitations.status,
    invitations.created_at,
    teams.owner_id,
    teams.title,
    teams.city,
    teams.image,
    teams.game,
    teams.members
   FROM (public.invitations
     LEFT JOIN public.teams ON ((teams.id = invitations.team_id)));
 &   DROP VIEW public.v_teams_invitations;
       public          postgres    false    248    248    248    248    248    248    248    252    252    252    252    252    990    993            �            1259    17906    v_users_invitations    VIEW     �  CREATE VIEW public.v_users_invitations AS
 SELECT invitations.id,
    invitations.user_id,
    invitations.team_id,
    teams.owner_id,
    invitations.status,
    invitations.created_at,
    users.email,
    users.username,
    users.name,
    users.surname,
    users.avatar,
    users.phone
   FROM ((public.invitations
     LEFT JOIN public.users ON ((users.id = invitations.user_id)))
     LEFT JOIN public.teams ON ((teams.id = invitations.team_id)));
 &   DROP VIEW public.v_users_invitations;
       public          postgres    false    247    252    252    252    252    252    248    248    247    247    247    247    247    247    993            �          0    17376    cache_inval_bgw_job 
   TABLE DATA           9   COPY _timescaledb_cache.cache_inval_bgw_job  FROM stdin;
    _timescaledb_cache          postgres    false    237   (|       �          0    17379    cache_inval_extension 
   TABLE DATA           ;   COPY _timescaledb_cache.cache_inval_extension  FROM stdin;
    _timescaledb_cache          postgres    false    238   E|       �          0    17373    cache_inval_hypertable 
   TABLE DATA           <   COPY _timescaledb_cache.cache_inval_hypertable  FROM stdin;
    _timescaledb_cache          postgres    false    236   b|       �          0    16944 
   hypertable 
   TABLE DATA             COPY _timescaledb_catalog.hypertable (id, schema_name, table_name, associated_schema_name, associated_table_prefix, num_dimensions, chunk_sizing_func_schema, chunk_sizing_func_name, chunk_target_size, compression_state, compressed_hypertable_id, replication_factor) FROM stdin;
    _timescaledb_catalog          postgres    false    207   |       �          0    17030    chunk 
   TABLE DATA           w   COPY _timescaledb_catalog.chunk (id, hypertable_id, schema_name, table_name, compressed_chunk_id, dropped) FROM stdin;
    _timescaledb_catalog          postgres    false    216   �|       �          0    16995 	   dimension 
   TABLE DATA           �   COPY _timescaledb_catalog.dimension (id, hypertable_id, column_name, column_type, aligned, num_slices, partitioning_func_schema, partitioning_func, interval_length, integer_now_func_schema, integer_now_func) FROM stdin;
    _timescaledb_catalog          postgres    false    212   �|       �          0    17014    dimension_slice 
   TABLE DATA           a   COPY _timescaledb_catalog.dimension_slice (id, dimension_id, range_start, range_end) FROM stdin;
    _timescaledb_catalog          postgres    false    214   �|       �          0    17051    chunk_constraint 
   TABLE DATA           �   COPY _timescaledb_catalog.chunk_constraint (chunk_id, dimension_slice_id, constraint_name, hypertable_constraint_name) FROM stdin;
    _timescaledb_catalog          postgres    false    217   �|       �          0    17085    chunk_data_node 
   TABLE DATA           [   COPY _timescaledb_catalog.chunk_data_node (chunk_id, node_chunk_id, node_name) FROM stdin;
    _timescaledb_catalog          postgres    false    220   }       �          0    17069    chunk_index 
   TABLE DATA           o   COPY _timescaledb_catalog.chunk_index (chunk_id, index_name, hypertable_id, hypertable_index_name) FROM stdin;
    _timescaledb_catalog          postgres    false    219   -}       �          0    17221    compression_chunk_size 
   TABLE DATA             COPY _timescaledb_catalog.compression_chunk_size (chunk_id, compressed_chunk_id, uncompressed_heap_size, uncompressed_toast_size, uncompressed_index_size, compressed_heap_size, compressed_toast_size, compressed_index_size, numrows_pre_compression, numrows_post_compression) FROM stdin;
    _timescaledb_catalog          postgres    false    232   J}       �          0    17150    continuous_agg 
   TABLE DATA           �   COPY _timescaledb_catalog.continuous_agg (mat_hypertable_id, raw_hypertable_id, user_view_schema, user_view_name, partial_view_schema, partial_view_name, bucket_width, direct_view_schema, direct_view_name, materialized_only) FROM stdin;
    _timescaledb_catalog          postgres    false    226   g}       �          0    17181 +   continuous_aggs_hypertable_invalidation_log 
   TABLE DATA           �   COPY _timescaledb_catalog.continuous_aggs_hypertable_invalidation_log (hypertable_id, lowest_modified_value, greatest_modified_value) FROM stdin;
    _timescaledb_catalog          postgres    false    228   �}       �          0    17171 &   continuous_aggs_invalidation_threshold 
   TABLE DATA           h   COPY _timescaledb_catalog.continuous_aggs_invalidation_threshold (hypertable_id, watermark) FROM stdin;
    _timescaledb_catalog          postgres    false    227   �}       �          0    17185 0   continuous_aggs_materialization_invalidation_log 
   TABLE DATA           �   COPY _timescaledb_catalog.continuous_aggs_materialization_invalidation_log (materialization_id, lowest_modified_value, greatest_modified_value) FROM stdin;
    _timescaledb_catalog          postgres    false    229   �}       �          0    17202    hypertable_compression 
   TABLE DATA           �   COPY _timescaledb_catalog.hypertable_compression (hypertable_id, attname, compression_algorithm_id, segmentby_column_index, orderby_column_index, orderby_asc, orderby_nullsfirst) FROM stdin;
    _timescaledb_catalog          postgres    false    231   �}       �          0    16966    hypertable_data_node 
   TABLE DATA           x   COPY _timescaledb_catalog.hypertable_data_node (hypertable_id, node_hypertable_id, node_name, block_chunks) FROM stdin;
    _timescaledb_catalog          postgres    false    208   �}       �          0    17142    metadata 
   TABLE DATA           R   COPY _timescaledb_catalog.metadata (key, value, include_in_telemetry) FROM stdin;
    _timescaledb_catalog          postgres    false    225   ~       �          0    17236 
   remote_txn 
   TABLE DATA           Y   COPY _timescaledb_catalog.remote_txn (data_node_name, remote_transaction_id) FROM stdin;
    _timescaledb_catalog          postgres    false    233   g~       �          0    16980 
   tablespace 
   TABLE DATA           V   COPY _timescaledb_catalog.tablespace (id, hypertable_id, tablespace_name) FROM stdin;
    _timescaledb_catalog          postgres    false    210   �~       �          0    17099    bgw_job 
   TABLE DATA           �   COPY _timescaledb_config.bgw_job (id, application_name, schedule_interval, max_runtime, max_retries, retry_period, proc_schema, proc_name, owner, scheduled, hypertable_id, config) FROM stdin;
    _timescaledb_config          postgres    false    222   �~       �          0    17866    invitations 
   TABLE DATA           O   COPY public.invitations (id, user_id, team_id, status, created_at) FROM stdin;
    public          postgres    false    252   �~       �          0    17911    matches 
   TABLE DATA           P   COPY public.matches (id, host_id, opponent_id, place, date, status) FROM stdin;
    public          postgres    false    256          �          0    17608    teams 
   TABLE DATA           ]   COPY public.teams (id, owner_id, title, city, description, image, game, members) FROM stdin;
    public          postgres    false    248   �       �          0    17592    users 
   TABLE DATA           \   COPY public.users (id, email, username, password, name, surname, avatar, phone) FROM stdin;
    public          postgres    false    247   ��       �          0    17616    users_teams 
   TABLE DATA           7   COPY public.users_teams (user_id, team_id) FROM stdin;
    public          postgres    false    249   ��       �           0    0    chunk_constraint_name    SEQUENCE SET     R   SELECT pg_catalog.setval('_timescaledb_catalog.chunk_constraint_name', 1, false);
          _timescaledb_catalog          postgres    false    218            �           0    0    chunk_id_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('_timescaledb_catalog.chunk_id_seq', 1, false);
          _timescaledb_catalog          postgres    false    215            �           0    0    dimension_id_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('_timescaledb_catalog.dimension_id_seq', 1, false);
          _timescaledb_catalog          postgres    false    211            �           0    0    dimension_slice_id_seq    SEQUENCE SET     S   SELECT pg_catalog.setval('_timescaledb_catalog.dimension_slice_id_seq', 1, false);
          _timescaledb_catalog          postgres    false    213            �           0    0    hypertable_id_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('_timescaledb_catalog.hypertable_id_seq', 1, false);
          _timescaledb_catalog          postgres    false    206            �           0    0    bgw_job_id_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('_timescaledb_config.bgw_job_id_seq', 1000, false);
          _timescaledb_config          postgres    false    221            �           0    0    invitations_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.invitations_id_seq', 19, true);
          public          postgres    false    253            �           0    0    matches_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.matches_id_seq', 13, true);
          public          postgres    false    257            �           0    0    teams_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.teams_id_seq', 24, true);
          public          postgres    false    251            �           0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 9, true);
          public          postgres    false    250            6           2606    17894    invitations invitation_pk 
   CONSTRAINT     W   ALTER TABLE ONLY public.invitations
    ADD CONSTRAINT invitation_pk PRIMARY KEY (id);
 C   ALTER TABLE ONLY public.invitations DROP CONSTRAINT invitation_pk;
       public            postgres    false    252            :           2606    17916    matches matches_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.matches
    ADD CONSTRAINT matches_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.matches DROP CONSTRAINT matches_pkey;
       public            postgres    false    256            /           2606    17615    teams teams_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.teams
    ADD CONSTRAINT teams_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.teams DROP CONSTRAINT teams_pkey;
       public            postgres    false    248            -           2606    17599    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    247            1           2606    17786    users_teams users_teams_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.users_teams
    ADD CONSTRAINT users_teams_pkey PRIMARY KEY (user_id, team_id);
 F   ALTER TABLE ONLY public.users_teams DROP CONSTRAINT users_teams_pkey;
       public            postgres    false    249    249            7           1259    17924    fki_host_id_team_id_fk    INDEX     M   CREATE INDEX fki_host_id_team_id_fk ON public.matches USING btree (host_id);
 *   DROP INDEX public.fki_host_id_team_id_fk;
       public            postgres    false    256            2           1259    17886    fki_inviation_team_fk    INDEX     P   CREATE INDEX fki_inviation_team_fk ON public.invitations USING btree (team_id);
 )   DROP INDEX public.fki_inviation_team_fk;
       public            postgres    false    252            3           1259    17880    fki_invitation_team_fk    INDEX     Q   CREATE INDEX fki_invitation_team_fk ON public.invitations USING btree (team_id);
 *   DROP INDEX public.fki_invitation_team_fk;
       public            postgres    false    252            4           1259    17892    fki_invitation_user_fk    INDEX     Q   CREATE INDEX fki_invitation_user_fk ON public.invitations USING btree (user_id);
 *   DROP INDEX public.fki_invitation_user_fk;
       public            postgres    false    252            8           1259    17930    fki_opponent_id_team_id    INDEX     R   CREATE INDEX fki_opponent_id_team_id ON public.matches USING btree (opponent_id);
 +   DROP INDEX public.fki_opponent_id_team_id;
       public            postgres    false    256            @           2606    17934    matches host_id_team_id_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.matches
    ADD CONSTRAINT host_id_team_id_fk FOREIGN KEY (host_id) REFERENCES public.teams(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 D   ALTER TABLE ONLY public.matches DROP CONSTRAINT host_id_team_id_fk;
       public          postgres    false    248    256    3375            >           2606    17881    invitations inviation_team_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.invitations
    ADD CONSTRAINT inviation_team_fk FOREIGN KEY (team_id) REFERENCES public.teams(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 G   ALTER TABLE ONLY public.invitations DROP CONSTRAINT inviation_team_fk;
       public          postgres    false    252    3375    248            ?           2606    17887    invitations invitation_user_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.invitations
    ADD CONSTRAINT invitation_user_fk FOREIGN KEY (user_id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 H   ALTER TABLE ONLY public.invitations DROP CONSTRAINT invitation_user_fk;
       public          postgres    false    252    3373    247            A           2606    17939    matches opponent_id_team_id    FK CONSTRAINT     �   ALTER TABLE ONLY public.matches
    ADD CONSTRAINT opponent_id_team_id FOREIGN KEY (opponent_id) REFERENCES public.teams(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 E   ALTER TABLE ONLY public.matches DROP CONSTRAINT opponent_id_team_id;
       public          postgres    false    256    3375    248            ;           2606    17765    teams owner_user_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.teams
    ADD CONSTRAINT owner_user_fk FOREIGN KEY (owner_id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 =   ALTER TABLE ONLY public.teams DROP CONSTRAINT owner_user_fk;
       public          postgres    false    247    248    3373            =           2606    17780    users_teams team_users_teams_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.users_teams
    ADD CONSTRAINT team_users_teams_fk FOREIGN KEY (team_id) REFERENCES public.teams(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 I   ALTER TABLE ONLY public.users_teams DROP CONSTRAINT team_users_teams_fk;
       public          postgres    false    248    3375    249            <           2606    17775    users_teams user_users_teams_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.users_teams
    ADD CONSTRAINT user_users_teams_fk FOREIGN KEY (user_id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 I   ALTER TABLE ONLY public.users_teams DROP CONSTRAINT user_users_teams_fk;
       public          postgres    false    249    247    3373            �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �   B   x�K�(�/*IM�/-�L�L5O�H1H��M4N��5135�MLLL�M�H5303L14�H�,����� .:�      �      x������ � �      �      x������ � �      �      x������ � �      �   Q   x�34�4�42�H�K��K�4202�50�54�24��%e�2�*e�i�	�wLNN-(IMA��Z�æ�d�1Vm1z\\\ D�$�      �   �   x�m�A�@����{���J.��-�.F�������Z����x����d�2��=��&����b���������!�m��vu��̔`��Ym?�e�Ӥ�ZiT��~ձZx�8����6s9ۭ�<9��c>�L?      �   �  x��KS�0��Χ�0eHBSm�G�0���M�X�\=����I�r�^s�������V��$�C����5i�	��@'�e��yL�t�0�̃/��OK����T
R�\:������P���ў�3����4W7��	����L������y|p1��X��v����C�Qd�?��B�s���P���4xit,��{���a��8V�͢���B_A��j��F*lD�tQ/(Y>ZّFg:�((��51�ï���Ş��
9fT�����������	�+ɧ�66�k
o�P�-���l�0?����pw��������%���3�c�V$�ko&�X��@Q���o���,���S�����C�nM�G�e)\T!�8���]u�ٙu��
nP�+�Ƽ ���3�ɕ��P�CTScV���|�Äҹ��Kol4a�K�'�a����jʳm9)�4���
�#�YcaC5�2�n���1󮢤8���8J��.� u6��Zi�Nq�1�1+5f�Jq��xN��LE^V\��f�̙��a�X����#j�Y*l�>֊h�:��"5BKR�����>�}z�biy$�M>.�g���X�x;�jMN�s��/.���y�� ���-��[��KF�K��.mEX�"Β��sz�m��>�g����n����yR=>k�#��'j>�F�snR'�Gv'-�������~vZ��_3�X�      �   �  x�e�ɒ�P ��<E/�2^vaR@1�T�J]��E&���m�5ٜ�__qP(�~$0�)/K��oz�C��̰)v�8�nB��,��M�����8�,Į���߬�rt�ϳ]_|VNy�E��`#��/�ooX�!���ư���DQ�$i4R��%M�g�{
��y&��4Klk2q�ꂞ�f"	
By��mlcc�f�{_�=	�CD&���t�*��'yWV��ia����e�C�ɒ7}i�=
]:��x�Ј���8sR5��WݵꔩrC��M�Z|Y��uU}F���wspRC�'z�  �5r��~�C=�K#ע�m%��x�z�նSgr�/�r'��T��:59�g��Y�W��IX�aG�U�K�j��j��Û҂W�,�,�rG�z��Pͳ�D�̛�#�|s�Zt�+8**WkK��[}T%8��@��W�f�}�؃�fXܾK1��Ĩ,�	�鐎/Xҏ�+����w�"�	��\      �      x���44�2�42����� �     