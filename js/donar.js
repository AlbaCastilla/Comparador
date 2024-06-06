// Mostrar el modal si hay detalles del pedido
document.addEventListener('DOMContentLoaded', function() {
    var orderDetailsModal = document.getElementById('orderDetailsModal');

    // Verificar si hay detalles del pedido
    var hasOrderDetails = <?php echo $orderDetails ? 'true' : 'false'; ?>;

    if (hasOrderDetails) {
        orderDetailsModal.style.display = 'flex'; // Mostrar el modal
    }
});

// Función para cerrar el modal
function closeModal() {
    var orderDetailsModal = document.getElementById('orderDetailsModal');
    orderDetailsModal.style.display = 'none';
}
