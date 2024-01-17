<?php
$list = [];
$qContacts = $con->query("SELECT * FROM contacts");
while ($contact = $qContacts->fetch_assoc()) {
    $list[] = $contact['phone'];
}
if (isset($_FILES['file'])) {
    $filename = $_FILES['file']['tmp_name'];
    $data = file_get_contents($filename);
    $data = explode("\n", $data);


    foreach ($data as $contact) {
        if ((strlen($contact) <= 7) || strlen($contact) > 15 || in_array($contact, $list)) continue;
        $phone = E($contact);
        $con->query("INSERT INTO contacts (phone) VALUES ('$phone')");
    }
}
?>
<div class="container section">
    <h5>Contatos (<?= count($list) ?>)</h5>

    <form id="upload-list-form" action="" method="POST" enctype="multipart/form-data">
        <div class="file-field input-field">
            <div class="btn">
                <span>Carregar lista</span>
                <input type="file" name="file" id="file">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" style="visibility: hidden;" name="file" type="text">
            </div>
        </div>
    </form>

    <ul class="collection">
        <?php
        $qContacts = $con->query("SELECT * FROM contacts ORDER BY id DESC");
        while ($contact = $qContacts->fetch_assoc()) {
            echo "<li class=\"collection-item\">$contact[phone]</li>";
        }

        ?>
    </ul>
</div>
<script>
    document.getElementById("file").addEventListener("change", e => {
        document.getElementById("upload-list-form").submit();
    })
</script>