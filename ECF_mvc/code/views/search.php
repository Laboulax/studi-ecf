
        <main>

            <section class="detail-travel">
                <form method="post" action="" class="form">
                    <div class="input-ctrl">
                        <label for="search-d">
                            <img src="img/icons-car.png" alt="">
                        </label>
                        <input type="text" id="search-d" name="search-d" placeholder="Ville de départ">
                    </div>

                    <div class="input-ctrl">
                        <label for="search-a">
                            <img src="img/icons-car.png" alt="">
                        </label>
                        <input type="text" id="search-a" name="search-a" placeholder="Ville d'arrivée" <?= $ville?>>
                    </div>

                    <div class="input-ctrl">
                        <label for="voyageurs">Nombre de voyageurs : </label>
                        <select type="text" name="voyageurs" id="voyageurs" required>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>

                    <!-- Idée pour choisir son statut conducteur / passager - Pourra resservir
                    <div id="choiceStatut">
                        <div>
                            <input type="radio" name="statut" id="passager" required checked><label for="passager"></label>
                            Passager</label>
                        </div>
                        <div>
                            <input type="radio" name="statut" id="conducteur" required><label for="conducteur">
                                Conducteur</label>
                        </div>
                    </div>-->

                    <div class="bouton_menu"><button class="button_go" type="submit" name="go">Recherche d'Ecoriders</button></div>

                </form>
            </section>

            <?php

            $servername = "localhost";
            $username = "root";
            $password = "";

            try {
                $bdd = new PDO("mysql:host=$servername;dbname=ecoride", $username, $password);
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }

            if (isset($_POST['go'])) {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $depart = $_POST['search-d'];
                    $arrivee = $_POST['search-a'];
                    $nbplace = $_POST['voyageurs'];
                    if ($depart != "" && $arrivee != "") {
                        $req = $bdd->query("SELECT *, TIMEDIFF(heure_arrivee, heure_depart) AS 'hdif' FROM `covoiturages` INNER JOIN `voitures` ON car_covoit = voiture_id INNER JOIN `utilisateurs` ON utilisateur_id = appartient_voiture WHERE lieu_depart='$depart' AND lieu_arrivee='$arrivee' AND nb_place >= '$nbplace'");
            ?>
                        <table>
                            <caption style=" caption-side: bottom; padding: 10px; font-weight: bold;">
                                Il y a <?php echo $req->rowCount(); ?> covoiturages correspondant à vos critères
                            </caption>
                            <thead style="background-color: rgb(228 240 245);">
                                <tr>
                                    <th scope="col">Voyagez avec</th>
                                    <th scope="col">Date départ</th>
                                    <th scope="col">Heure départ</th>
                                    <th scope="col">Heure d'arrivée</th>
                                    <th scope="col">durée</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">energie</th>
                                    <th scope="col">Nombre de place</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($req as $value) {
                                    $dep = $value['date_depart'];
                                    $arr = $value['date_arrivee'];
                                    $hdep = $value['heure_depart'];
                                    $harr = $value['heure_arrivee'];
                                    $place = $value['nb_place'];
                                    $prix = $value['prix_personne'];
                                    $energie = $value['energie'];
                                    $pseudo = $value['pseudo'];
                                    $hdif = $value['hdif'];
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $pseudo ?></th>
                                        <td><?php echo $dep ?></td>
                                        <td><?php echo $hdep ?></td>
                                        <td><?php echo $harr ?></td>
                                        <td><?php echo $hdif ?></td>
                                        <td><?php echo $prix ?> €</td>
                                        <td><?php echo $energie ?></td>
                                        <td><?php echo $place ?></td>
                                    </tr>

                                <?php
                                } ?>
                            </tbody>
                        </table>
            <?php
                    }
                }
            }


            ?>


        </main>