window.addEventListener('swal:confirm-appointment', event => {
    let detail = event.detail[0];
    Swal.fire({
        title: 'Você tem certeza?',
        text: 'Deseja deletar este agendamento?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, delete este agendamento!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatch('deleteAppointmentConfirmed', { commentId: detail.commentId });
        }
    });
});