-- INSERTION DES UTILISATEURS
INSERT INTO user (login, password, role) VALUES
('yannick', '123', 'admin'),
('james', '123', 'admin'),
('pierre', '123', 'user'),
('paul', '123', 'user'),
('martin', '123', 'user');





-- INSERTION DES COMMENTAIRES
INSERT INTO comment (comment, date, id_user) VALUES
("Ce quiz était vraiment intéressant, mais certaines questions étaient un peu trop difficiles.", 2025-02-13 12:10:00, 3),
("J'ai adoré ce quiz, il m'a permis d'en apprendre davantage sur un sujet que je ne connaissais pas du tout.", 2025-02-16 12:09:00, 3),
("Les questions étaient très bien conçues, mais il manquait un peu plus de variété.", 2025-02-16 12:15:00, 3),
("Je n'ai pas aimé la durée du quiz, c'était un peu trop long pour moi.", 2025-02-15 12:35:00, 3),
("Le quiz était amusant, mais je pense qu'il devrait y avoir plus de questions à choix multiples.", 2025-02-17 12:16:00, 3),
("Très bien, mais les résultats n'étaient pas assez détaillés. J'aurais aimé savoir où j'avais fait des erreurs.", 2025-02-17 12:11:00, 4),
("Excellent quiz! J'ai appris de nouvelles choses et ça m'a donné envie d'en faire plus.", 2025-02-14 12:25:00, 4),
("Quiz assez facile, mais il manque un peu de challenge. Peut-être plus de questions sur des sujets avancés.", 2025-02-16 12:29:00, 4),
("C'était un bon quiz, mais certaines questions étaient un peu ambiguës.", 2025-02-12 12:28:00, 4),
("J'ai apprécié l'expérience, mais il y a quelques erreurs dans les réponses proposées.", 2025-02-11 12:12:00, 4),
("J'adore les quiz interactifs comme celui-ci, j'espère qu'il y en aura d'autres sur des sujets différents.", 2025-02-16 13:00:00, 3),
("Le quiz était bien, mais il y a eu quelques problèmes techniques, ça m'a empêché de finir.", 2025-02-14 14:00:00, 5),
("Vraiment trop facile pour un quiz avancé. J'espérais un peu plus de difficulté.", 2025-02-13 10:31:00, 5),
("Ce quiz était très bien structuré et m'a permis de tester mes connaissances sur le sujet.", 2025-02-15 12:02:00, 5),
("Je n'ai pas aimé les options de réponse. Certaines étaient trop proches les unes des autres.", 2025-02-09 11:59:00, 5),
("Un bon moyen de passer du temps, mais il manque de feedback sur pourquoi certaines réponses sont incorrectes.", 2025-02-17 11:56:00, 5),
("C'était un excellent quiz, mais la musique de fond était un peu distrayante.", 2025-02-10 12:12:08, 3),
("Très intéressant, j'ai appris des faits surprenants que je ne savais pas avant.", 2025-02-11 12:12:10, 4),
("J'ai trouvé ce quiz trop court, il aurait pu avoir plus de questions pour être plus complet.", 2025-02-13 12:08:09, 5),
("Le quiz était bien conçu, mais je pense que la difficulté devrait être augmentée pour rendre l'expérience plus stimulante.", 2025-02-12 12:06:00, 3);