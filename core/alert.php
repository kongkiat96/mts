<?php
// Set Alert  Timer 1000 = 1 วิ 
$chk_user = '
    <script type="text/javascript">
        Swal.fire({

            icon: "error",
            title: "ชื่อผู้ใช้งาน หรือรหัสผ่านผิด",
            timer: 2000,  
            showConfirmButton: false
        })
    </script>';
$ch_user = '
    <script type="text/javascript">
        Swal.fire({

            icon: "warning",
            title: "รหัสพนักงานมีอยู่แล้ว",
            timer: 2000,  
            showConfirmButton: false
        })
    </script>';
$success = '<script type="text/javascript">
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "บันทึกเรียบร้อย...",
        timer: 3000,  
        showConfirmButton: false
    })
</script>';
$warning = '<script type="text/javascript">
    Swal.fire({
        icon: "error",
        title: "ข้อมูลบางอย่างไม่ถูกต้อง",
        timer: 3000,  
        showConfirmButton: false
    })
</script>';

$counterror = '<script type="text/javascript">
    Swal.fire({
        icon: "warning",
        title: "มีข้อมูลในระบบแล้ว",
        timer: 3000,  
        showConfirmButton: false
    })
</script>';

$selectdata = '<script type="text/javascript">
    Swal.fire({
        icon: "warning",
        title: "เลือกข้อมูล",
        timer: 3000,  
        showConfirmButton: false
    })
</script>';

$saveedit = '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "success",
    title: "แก้ไขเรียบร้อย...",
    timer: 3000,  
    showConfirmButton: false
  })
</script>';

$ck_pass = '<script type="text/javascript">
    Swal.fire({
        icon: "warning",
        title: "รหัสผ่านไม่ตรงกัน",
        timer: 3000,  
        showConfirmButton: false
    })
</script>';

$newproject = '<script type="text/javascript">
    Swal.fire({
        icon: "warning",
        title: "กำลังอยู่ในระหว่างปรับปรุง",
        timer: 3000,  
        showConfirmButton: false
    })
    setTimeout(function () {
        window.location.href = "index.php";
     }, 4000);
</script>';

$lock = '<script type="text/javascript">
Swal.fire({
    icon: "error",
    title: "ไม่ได้รับอนุญาตสิทธิ์การเข้าถึง ระบบได้ล๊อคการเข้าถึงแล้ว และรอการตรวจสอบ",
    timer: 10000,  
    showConfirmButton: false
});
</script>';

$wrongPassword = '<script type="text/javascript">
    Swal.fire({
        icon: "error",
        title: "รหัสผ่านเดิมไม่ถูกต้อง",
        timer: 3000,  
        showConfirmButton: false
    })
</script>';