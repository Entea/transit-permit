import Swal from "sweetalert2";

function Alert(title, icon = "success") {
  Swal.fire({
    showConfirmButton: true,
    icon: icon,
    width: 500,
    title: title,
    timer: 2000,
    confirmButtonColor: "#F7A810"
  });
}

export default Alert;
