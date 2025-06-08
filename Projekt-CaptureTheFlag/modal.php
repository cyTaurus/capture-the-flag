<link rel="stylesheet" href="../assets/style/style.css">

<div id="modalForHints" class="modal" style="display:none;">
    <div class="modal-content">
        <span onclick="document.getElementById('modalForHints').style.display='none'" class="close" style="cursor: pointer;">&times;</span>
        <?php echo isset($modalContent) ? $modalContent : 'Kein Hinweis.'; ?>
    </div>
</div>
<script>
    function openModal() {
        document.getElementById('modalForHints').style.display = 'block';
    }
</script>