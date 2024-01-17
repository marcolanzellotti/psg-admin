<div class="container section">
    <h5>Autores <a href="?view=new_mentor" class="secondary-content"><i class="material-icons">add_box</i> Novo</a>
    </h5>
    <div class="collection">
        <?php
        $qMentors = $con->query("SELECT * FROM mentors WHERE is_author=1");
        while ($mentor = $qMentors->fetch_assoc()) {
            echo "<a href=\"?view=edit_mentor&mentor=$mentor[id]\" class=\"collection-item\">$mentor[name]</a>";
        }

        ?>
    </div>
</div>

<div class="container section">
    <h5>Co-Autores <a href="?view=new_mentor" class="secondary-content"><i class="material-icons">add_box</i> Novo</a>
    </h5>
    <div class="collection">
        <?php
        $qMentors = $con->query("SELECT * FROM mentors WHERE is_co_author=1");
        while ($mentor = $qMentors->fetch_assoc()) {
            echo "<a href=\"?view=edit_mentor&mentor=$mentor[id]\" class=\"collection-item\">$mentor[name]</a>";
        }

        ?>
    </div>
</div>

<div class="container section">
    <h5>Mentores <a href="?view=new_mentor" class="secondary-content"><i class="material-icons">add_box</i> Novo</a>
    </h5>
    <div class="collection">
        <?php
        $qMentors = $con->query("SELECT * FROM mentors WHERE is_author=0 AND is_co_author=0");
        while ($mentor = $qMentors->fetch_assoc()) {
            echo "<a href=\"?view=edit_mentor&mentor=$mentor[id]\" class=\"collection-item\">$mentor[name]</a>";
        }

        ?>
    </div>
</div>