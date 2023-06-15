------------------------------------------------------------------------------
----------------------------- Enum Types -------------------------------------
------------------------------------------------------------------------------

CREATE TYPE sports AS ENUM ('Football','Voleyball','Basketball','Tenis');
CREATE TYPE status AS ENUM ('Pending','Accepted','Rejected');


------------------------------------------------------------------------------
-------------------------------- Tables --------------------------------------
------------------------------------------------------------------------------


----------------------------- Users Tabel  -----------------------------------
CREATE TABLE users(
	"id" SERIAL PRIMARY KEY,
	email VARCHAR(63) NOT NULL UNIQUE,
	username VARCHAR(63) NOT NULL UNIQUE,
	"password" VARCHAR(255) NOT NULL,
	"name" VARCHAR(31) NOT NULL DEFAULT 'User',
	surname VARCHAR (31) NOT NULL DEFAULT 'Anonymous',
	avatar VARCHAR (255)NOT NULL DEFAULT 'default_avatar.png',
	phone VARCHAR(15)NOT NULL DEFAULT '-'
);




----------------------------- Teams Tabel  -----------------------------------
CREATE TABLE teams (
	"id" SERIAL PRIMARY KEY,
	owner_id SERIAL REFERENCES users("id") ON DELETE CASCADE ON UPDATE CASCADE NOT NULL,
	title VARCHAR(31) NOT NULL UNIQUE,
	city VARCHAR(31)NOT NULL,
	game sports NOT NULL,
	description VARCHAR(511) NOT NULL,
	image VARCHAR(255) NOT NULL,
	members INT NOT NULL DEFAULT 1
);



--------------------------- Teams Users Tabel  -------------------------------
CREATE TABLE users_teams (
	user_id SERIAL REFERENCES users("id") ON DELETE CASCADE ON UPDATE CASCADE NOT NULL,
	team_id SERIAL REFERENCES teams("id") ON DELETE CASCADE ON UPDATE CASCADE NOT NULL,
	PRIMARY KEY(user_id, team_id)
);



--------------------------- Inviatations Tabel  ------------------------------
CREATE TABLE invitations (
    "id" SERIAL PRIMARY KEY,
	user_id SERIAL REFERENCES users("id") ON DELETE CASCADE ON UPDATE CASCADE NOT NULL,
	team_id SERIAL REFERENCES teams("id") ON DELETE CASCADE ON UPDATE CASCADE NOT NULL,
	status status NOT NULL DEFAULT 'Pending',
	created_at DATE DEFAULT CURRENT_DATE NOT NULL
);



----------------------------- Games Tabel  -----------------------------------
CREATE TABLE games (
	"id" SERIAL PRIMARY KEY,
	host_id SERIAL REFERENCES teams("id") ON DELETE CASCADE ON UPDATE CASCADE NOT NULL,
	opponent_id SERIAL REFERENCES teams("id") ON DELETE CASCADE ON UPDATE CASCADE NOT NULL,
	place VARCHAR(31) NOT NULL,
	"date" TIMESTAMP  WITH TIME ZONE NOT NULL,
	status status DEFAULT 'Pending'
);


------------------------------------------------------------------------------
--------------------------------- Views --------------------------------------
------------------------------------------------------------------------------


----------------------  Teams Inviatations View  -----------------------------
CREATE OR REPLACE VIEW v_teams_invitations AS SELECT invitations.id, user_id, team_id, "status", created_at, owner_id, title, city, "image", game, members  FROM invitations LEFT JOIN teams ON  teams.id = invitations.team_id;


----------------------  Users Inviatations View  -----------------------------
CREATE OR REPLACE VIEW v_users_invitations AS SELECT invitations.id, user_id, team_id, owner_id, "status", created_at, email, username, "name", surname, avatar, phone FROM invitations LEFT JOIN users ON  users.id = invitations.user_id  LEFT JOIN teams ON  teams.id = invitations.team_id;


--------------------------  Games Teams View  --------------------------------
CREATE OR REPLACE VIEW v_games_teams AS SELECT host.title host_title,  host.owner_id host_owner, host_id, games.id, place, "date", "status", opponent.title opponent_title,opponent.owner_id opponent_owner, opponent_id FROM games LEFT JOIN teams host ON  host.id = games.host_id  RIGHT JOIN teams opponent ON  opponent.id = games.opponent_id;



------------------------------------------------------------------------------
----------------------------- PROCEDURES  ------------------------------------
------------------------------------------------------------------------------


------------------------------   Delete Team  --------------------------------
CREATE OR REPLACE PROCEDURE deleteteam(
   teamId int,
   userId int
)
LANGUAGE plpgsql    
as $$
DECLARE
   team teams%ROWTYPE;
BEGIN
 
   SELECT * INTO team FROM teams WHERE id=teamId;

   IF team.owner_id = userId THEN
   DELETE FROM teams where id = teamId;
   END IF;

   COMMIT;
END;$$


------------------------------   Create Invitation  ---------------------------
CREATE OR REPLACE PROCEDURE createinvitation(
   userId int,
   teamId int
)
LANGUAGE plpgsql    
as $$
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
END;$$


------------------------------   Delete Invitation  ------------------------------
CREATE OR REPLACE PROCEDURE deleteinvitation(
   invId int,
   userId int
)
LANGUAGE plpgsql    
as $$
DECLARE
   invitation invitations%ROWTYPE;
BEGIN
 
   SELECT * INTO invitation FROM invitations WHERE id=invId AND  user_id=userId;

   IF invitation IS NOT NULL AND invitation.user_id = userId  THEN
   DELETE FROM invitations WHERE id=invId;
   END IF;

   COMMIT;
END;$$


------------------------------   Accept Invitation  ------------------------------
CREATE OR REPLACE PROCEDURE acceptinvitation(
   invId int,
   userId int
)
LANGUAGE plpgsql    
as $$
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


END;$$


------------------------------   Reject Invitation  ------------------------------
CREATE OR REPLACE PROCEDURE rejectinvitation(
   invId int,
   userId int
)
LANGUAGE plpgsql    
as $$
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
END;$$


------------------------------   Create Game  ------------------------------
CREATE OR REPLACE PROCEDURE creategame(
   userId int,
   hostId int,
   opponentId int,
   place character varying,
   game_date  character varying
)
LANGUAGE plpgsql    
as $$
DECLARE
   hostTeam teams%ROWTYPE;
   opponentTeam teams%ROWTYPE;
BEGIN
 

   SELECT * INTO hostTeam FROM teams WHERE teams.id=hostId;
   SELECT * INTO opponentTeam FROM teams WHERE teams.id=opponentId;

   IF hostTeam IS NOT NULL AND hostTeam.owner_id = userId AND  opponentTeam IS NOT NULL  AND hostTeam.id != opponentTeam.id AND hostTeam.game = opponentTeam.game   THEN
   INSERT INTO games (host_id, opponent_id, place, date) VALUES (hostId, opponentId, place, game_date::timestamp );
   END IF;

   COMMIT;
END;$$


------------------------------   Delete Game  ------------------------------
CREATE OR REPLACE PROCEDURE deletegame(
   userId integer,
   gameId integer
)
LANGUAGE plpgsql    
as $$
DECLARE
   hostTeam teams%ROWTYPE;
   gameRow games%ROWTYPE;
BEGIN
 
   SELECT * INTO gameRow FROM games WHERE id=gameId;
   SELECT * INTO hostTeam FROM teams WHERE id=gameRow.host_id;

   IF hostTeam IS NOT NULL AND hostTeam.owner_id = userId AND  gameRow IS NOT NULL THEN
   DELETE FROM games WHERE id=gameId;
   END IF;

   COMMIT;
END;$$


------------------------------   Accept Game  ------------------------------
CREATE OR REPLACE PROCEDURE acceptgame(
   userId integer,
   gameId integer
)
LANGUAGE plpgsql    
as $$
DECLARE
   gameRow games%ROWTYPE;
   opponentTeam teams%ROWTYPE;
BEGIN
 

   
   SELECT * INTO gameRow FROM games WHERE id=gameId;
   SELECT * INTO opponentTeam FROM teams WHERE id=gameRow.opponent_id;
      
   IF opponentTeam IS NOT NULL AND opponentTeam.owner_id = userId AND  gameRow IS NOT NULL THEN
      UPDATE games SET  status = 'Accepted' WHERE id=gameId;
   END IF;

   COMMIT;
END;$$


------------------------------   Reject Game  ------------------------------
CREATE OR REPLACE PROCEDURE rejectgame(
   userId integer,
   gameId integer
)
LANGUAGE plpgsql    
as $$
DECLARE
   gameRow games%ROWTYPE;
   opponentTeam teams%ROWTYPE;
  
BEGIN
 
   SELECT * INTO gameRow FROM games WHERE id=gameId;
   SELECT * INTO opponentTeam FROM teams WHERE id=gameRow.opponent_id;
      
   IF opponentTeam IS NOT NULL AND opponentTeam.owner_id = userId AND  gameRow IS NOT NULL THEN
      UPDATE games SET  status = 'Rejected' WHERE id=gameId;
   END IF;

   COMMIT;
END;$$



