CREATE TABLE players_info (
    id SERIAL PRIMARY KEY,
    player_name VARCHAR(50) NOT NULL UNIQUE,
    level INTEGER,
    member_since DATE NOT NULL,
    bio TEXT,
    matches_played INTEGER DEFAULT 0,
    win_rate DECIMAL(5,2),
    points INTEGER DEFAULT 0,
    achievements TEXT
);
SELECT*FROM players_info;
INSERT INTO players_info (player_name,level,member_since,bio,matches_played,win_rate,points,achievements)
VALUES('ZezoXD_BRUH',120,'12-9-2021','Toxic gamer',40,78.5,21000,'Top 3 Player');
VALUES('Mohamed Elmesareaa',90,'06-24-2023','Grinding is the key',21,81.3,9430,'Leveling up player');
VALUES('Tarook77',78,'01-4-2023','Chill gamer',21,64.23,3289,'Nice player');
VALUES('Safwaat_dx12',93,'05-26-2023','Average player',19,83.6,14000,'Dosent miss a headshot');
VALUES('Faze_Medo023',200,'07-13-2019','OG player',146,88.45,40230,'FETCH ME THEIR SOULS');
VALUES('Haythoom_got u',178,'09-10-2020','Sweat gamer',60,90.23,34600,'Now you see me');