--UserLogin
--
insert into UserLogin values(1, 'Matt Bogert', '360-689-7730');
insert into UserLogin values(2, 'Mark Gilbert', '111-111-1111');
insert into UserLogin values(3, 'Jessica Ugalde', '222-222-2222');
insert into UserLogin values(4, 'Daniel Rubin', '333-333-3333');
--Should Fail
insert into UserLogin values(1, 'Bob Smith', '444-444-4444');
insert into UserLogin values(5, 'Bob Smith', '360-689-7730');
insert into UserLogin values(5, 'Mark Gilbert', '444-444-4444');
insert into UserLogin values('Fail', 'Bob Smith', '444-444-4444');
insert into UserLogin values(5, 420, '444-444-4444');
insert into UserLogin values(5, 'Mark Gilbert', 3606897730);


--Login
--
insert into Login values(1, 'mbogert@pugetsound.edu', '$pIcy');
insert into Login values(2, 'mgilbert@pugetsound.edu', '$pIcy');
insert into Login values(3, 'jchanugalde@pugetsound.edu', '@$terix');
insert into Login values(4, 'drubin@pugetsound.edu', '%hash%');
--Should Fail
insert into Login values(1, 'bsmith@pugetsound.edu', '$pIcy');
insert into Login values(5, 'mbogert@pugetsound.edu', '$pIcy');
insert into Login values('1', 'bsmith@pugetsound.edu', '$pIcy');
insert into Login values(5, 420, '$pIcy');
insert into Login values(1, 'mbogert@pugetsound.edu', 420);
insert into Login values(5, 'bsmith@pugetsound.edu', '$pIcy');


--School
--
insert into School values(1, 'University of Puget Sound', 'pugetsound.edu');
insert into School values(2, 'University of Washington Seattle', 'uw.edu');
insert into School values(3, 'Evergreen State College', 'evergreen.edu');
--Should Fail
insert into School values(1, 'School of Hard Knocks', 'hknock.edu');
insert into School values(4, 'School of Hard Knocks', 'pugetsound.edu');
insert into School values('1', 'School of Hard Knocks', '@knock.edu');
insert into School values(4, 420, 'hknock.edu');
insert into School values(4, 'School of Hard Knocks', 420);


--Attends
--
insert into Attends values(1, 1);
insert into Attends values(2, 1);
insert into Attends values(3, 1);
insert into Attends values(4, 1);
--Should Fail
insert into Attends values(2, 2);
insert into Attends values(5, 3);
insert into Attends values('1',2);
insert into Attends values(1,'2');


--Recipe
--
insert into Recipe values('choc_chip_cookie.txt', 30);
insert into Recipe values('raw_cookie_dough.txt', 0);
insert into Recipe values('pecan_pie.txt', 90);
insert into Recipe values('vegan_choc_chip_cookie.txt', 30);
--Should Fail
insert into Recipe values('pecan_pie.txt', 90);
insert into Recipe values(420, 840);
insert into Recipe values('insert_error.txt', '30');

--Category 
--
insert into Category values('choc_chip_cookie.txt', 'Cookie');
insert into Category values('raw_cookie_dough.txt', 'Cookie');
insert into Category values('pecan_pie.txt', 'Pie');
insert into Category values('vegan_choc_chip_cookie.txt', 'Cookie');
insert into Category values('vegan_choc_chip_cookie.txt', 'Dietary');
--Should Fail
insert into Category values('choc_chip_cookie.txt', 'Cookie');
insert into Category values(420, 'Cookie');
insert into Category values('choc_chip_cookie.txt', 420);
insert into Category values('WUMBO', 'Cookie');

--BakeRequest
--
insert into BakeRequest values(1, '02:00', '03:00');
insert into BakeRequest values(2, '02:00', '03:00');
insert into BakeRequest values(4, '03:30', '07:00');
--Should Fail
insert into BakeRequest values(2, '02:00', '03:00');
insert into BakeRequest values(3, '02:00', '01:00');
insert into BakeRequest values('3', '02:00', '03:00');
insert into BakeRequest values(3, 2, '03:00');
insert into BakeRequest values(3, '02:00', 3);

/*
--BakeRecipe
--
insert into BakeRecipe values(1, 'choc_chip_cookie.txt');
insert into BakeRecipe values(1, 'raw_cookie_dough.txt');	
insert into BakeRecipe values(2, 'choc_chip_cookie.txt');
insert into BakeRecipe values(4, 'pecan_pie.txt');
--Should Fail
insert into BakeRecipe values(5, 'choc_chip_cookie.txt');
insert into BakeRecipe values(1, 'choc_chip_cookie.txt');
insert into BakeRecipe values('1', 'choc_chip_cookie.txt');
insert into BakeRecipe values(1, 420);
insert into BakeRecipe values(1, 'special_brownies.txt');
insert into BakeRecipe values(3, 'choc_chip_cookie.txt');
*/

--RequestCategory
--
insert into RequestCategory values(1, 'Cookie');
insert into RequestCategory values(2, 'Cookie');
insert into RequestCategory values(4, 'Dietary');
insert into RequestCategory values(2, 'Pie');
--Should Fail
insert into RequestCategory values(6, 'Cookie');
insert into RequestCategory values(1, 'Wumbo');
insert into RequestCategory values('1', 'Cookie');
insert into RequestCategory values(1, 420);

--Pair
--
insert into Pair values(1, 2, 'choc_chip_cookie.txt');
--Should Fail
insert into Pair values(1, 3, 'choc_chip_cookie.txt');
insert into Pair values('1', 2, 'choc_chip_cookie.txt');
insert into Pair values(1, '2', 'choc_chip_cookie.txt');
insert into Pair values(1, 2, 'special_brownies.txt');
insert into Pair values(1, 2, 420);