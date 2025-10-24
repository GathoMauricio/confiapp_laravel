<?php
session_save_path('');
session_start();
?>
<script>
localStorage.clear();
localStorage.setItem('year_x1', '<?php echo $_GET['x1'] ?? '';?>');
localStorage.setItem('sub_x1', '<?php echo $_GET['x2'] ?? '';?>');
localStorage.setItem('name_x1', '<?php echo $_GET['x3'] ?? '';?>');
localStorage.setItem('correo_x1', '<?php echo $_GET['x5'] ?? '';?>');
</script>
<?
if($_GET['x4'] == 2016){
?>
<script>
localStorage.setItem('value_x1', '73.04');
</script>
<?
} elseif($_GET['x4'] == 2017) {?>
<script>
localStorage.setItem('value_x1', '75.49');
</script>
<?
} elseif($_GET['x4'] == 2018) {?>
<script>
localStorage.setItem('value_x1', '80.60');
</script>
<?
} elseif($_GET['x4'] == 2019) {?>
<script>
localStorage.setItem('value_x1', '84.49');
</script>
<?
}elseif($_GET['x4'] == 2020) {?>
<script>
localStorage.setItem('value_x1', '86.88');
</script>
<?
}elseif($_GET['x4'] == 2021) {?>
<script>
localStorage.setItem('value_x1', '89.62');
</script>
<?
}elseif($_GET['x4'] == 2022) {?>
<script>
localStorage.setItem('value_x1', '96.22');
</script>
<?
}elseif($_GET['x4'] == 2023) {?>
<script>
localStorage.setItem('value_x1', '103.74');
</script>
<?
}elseif($_GET['x4'] == 2024) {?>
<script>
localStorage.setItem('value_x1', '108.57');
</script>
<?
}elseif($_GET['x4'] == 2025) {?>
<script>
localStorage.setItem('value_x1', '113.14');
</script>
<?
}
?>
<script type="text/javascript">
   	// Javascript URL redirection AGREGAR ELSEIF POR AÑO
    window.location.replace("{{ route('/') }}");
</script>
