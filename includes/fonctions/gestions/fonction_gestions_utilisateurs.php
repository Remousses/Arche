<?php
    function getUtilisateur(){
        $utilisateurs = $GLOBALS['connexion']->prepare('SELECT Id_utilisateur, Nom_utilisateur, Prenom_utilisateur, Nom_groupe FROM utilisateur, groupe WHERE utilisateur.Id_groupe = groupe.Id_groupe');
        $utilisateurs->execute();
?>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Groupe</th>
                <th class="d-none"></th>
                <th class="d-none"></th>
            </tr>
        </thead>
        <tbody>
<?php
        while($donnees = $utilisateurs->fetch()){
            echo '<tr>
                    <td>' . $donnees['Nom_utilisateur'] . '</td>
                    <td>' . $donnees['Prenom_utilisateur'] . '</td>
                    <td>' . $donnees['Nom_groupe'] . '</td>
                    <td class="text-center"><a href="includes/fonctions/fonction_modification.php?modifierUtilisateur=' . $donnees['Id_utilisateur'] . '"><i class="fa fa-edit"></i></a></td>
                    <td class="text-center"><a href="includes/fonctions/fonction_suppression.php?supprimerUtilisateur=' . $donnees['Id_utilisateur'] . '"><i class="fa fa-close"></i></a></td>
                </tr>';
        }

        $utilisateurs->closeCursor();           
?>
        </tbody>
<?php
    }

    function creerUtilisateur(){
?>
        <a class="btn btn-primary text-white" data-toggle="modal" data-target="#creerUtilisateur">Ajouter un utilisateur</a>

        <!-- Modal création utilisateur -->
        <div class="modal fade" id="creerUtilisateur" tabindex="-1" role="dialog" aria-labelledby="creerUtilisateurLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="creerUtilisateurLabel">Création d'un utilisateur</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="includes/fonctions/fonction_creation.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="informationsCandidater">Pourquoi vous intéressez-vous à cette alerte ?</label>
                                <textarea class="form-control" type="text" name="informationsCandidater" col="30" row ="6" maxlength="1000" placeholder="Votre texte" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="role">Rôle</label>
                                <div class="row" style="margin: auto;">
                                    <div class="col-6">
                                        <input type="radio" class="form-check-input" name="roleCandidater" value="Participer physiquement" checked>
                                        <label class="form-check-label" for="ParticiperPhysiquement">Participer physiquement</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" class="form-check-input" name="roleCandidater" value="Participer financièrement">
                                        <label class="form-check-label" for="ParticiperFinancièrement">Participer financièrement</label>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="idAlerteCandidater" name="idAlerteCandidater">
                            <input type="hidden" id="idEspeceCandidater" name="idEspeceCandidater">                            
                        </div>
                        <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                            <button class="btn btn-primary" type="submit" name="candidaterAlerte">Candidater</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
?>