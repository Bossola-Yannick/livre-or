-- INSERTION DES UTILISATEURS
INSERT INTO user (login, password, role) VALUES
('yannick', '123', 'admin'),
('james', '123', 'admin'),
('pierre', '123', 'user'),
('paul', '123', 'user'),
('martin', '123', 'user');





-- INSERTION DES COMMENTAIRES
INSERT INTO comment (comment, date, id_user) VALUES
("Ce quiz était vraiment intéressant, mais certaines questions étaient un peu trop difficiles.", NOW(), 3),
("J'ai adoré ce quiz, il m'a permis d'en apprendre davantage sur un sujet que je ne connaissais pas du tout.", NOW(), 3),
("Les questions étaient très bien conçues, mais il manquait un peu plus de variété.", NOW(), 3),
("Je n'ai pas aimé la durée du quiz, c'était un peu trop long pour moi.", NOW(), 3),
("Le quiz était amusant, mais je pense qu'il devrait y avoir plus de questions à choix multiples.", NOW(), 3),
("Très bien, mais les résultats n'étaient pas assez détaillés. J'aurais aimé savoir où j'avais fait des erreurs.", NOW(), 4),
("Excellent quiz! J'ai appris de nouvelles choses et ça m'a donné envie d'en faire plus.", NOW(), 4),
("Quiz assez facile, mais il manque un peu de challenge. Peut-être plus de questions sur des sujets avancés.", NOW(), 4),
("C'était un bon quiz, mais certaines questions étaient un peu ambiguës.", NOW(), 4),
("J'ai apprécié l'expérience, mais il y a quelques erreurs dans les réponses proposées.", NOW(), 4),
("J'adore les quiz interactifs comme celui-ci, j'espère qu'il y en aura d'autres sur des sujets différents.", NOW(), 3),
("Le quiz était bien, mais il y a eu quelques problèmes techniques, ça m'a empêché de finir.", NOW(), 5),
("Vraiment trop facile pour un quiz avancé. J'espérais un peu plus de difficulté.", NOW(), 5),
("Ce quiz était très bien structuré et m'a permis de tester mes connaissances sur le sujet.", NOW(), 5),
("Je n'ai pas aimé les options de réponse. Certaines étaient trop proches les unes des autres.", NOW(), 5),
("Un bon moyen de passer du temps, mais il manque de feedback sur pourquoi certaines réponses sont incorrectes.", NOW(), 5),
("C'était un excellent quiz, mais la musique de fond était un peu distrayante.", NOW(), 3),
("Très intéressant, j'ai appris des faits surprenants que je ne savais pas avant.", NOW(), 4),
("J'ai trouvé ce quiz trop court, il aurait pu avoir plus de questions pour être plus complet.", NOW(), 5),
("Le quiz était bien conçu, mais je pense que la difficulté devrait être augmentée pour rendre l'expérience plus stimulante.", NOW(), 3);