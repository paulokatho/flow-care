document.addEventListener('DOMContentLoaded', () => {
  const tabLinks = document.querySelectorAll('.tab-link');
  const tabContents = document.querySelectorAll('.tab-content');
  const toggleBtn = document.getElementById('toggle-btn');
  const sidebar = document.getElementById('sidebar');

  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
  });

  tabLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      tabLinks.forEach(link => link.classList.remove('active'));
      tabContents.forEach(content => content.classList.remove('active'));

      e.target.classList.add('active');
      const activeTab = document.querySelector(e.target.getAttribute('href'));
      activeTab.classList.add('active');
    });
  });

  // === AGENDAMENTO ===

  const horarios = {
    'segunda': ['08:00', '09:00', '10:00', '14:00'],
    'terca': ['09:00', '10:30', '13:00'],
    'quarta': ['08:30', '11:00'],
    'quinta': ['10:00', '14:30'],
    'sexta': ['09:00', '12:00']
  };

  const diasSemana = ['domingo', 'segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado'];

  const dateInput = document.getElementById('appointmentDate');
  const timeSelect = document.getElementById('appointmentTime');
  const nameInput = document.getElementById('patientName');
  const emailInput = document.getElementById('patientEmail');
  const scheduleBtn = document.getElementById('scheduleButton');

  dateInput.addEventListener('change', () => {
    const selectedDate = new Date(dateInput.value);
    const dayOfWeek = selectedDate.getDay();
    const dia = diasSemana[dayOfWeek];

    timeSelect.innerHTML = '';
    timeSelect.disabled = false;

    if (horarios[dia]) {
      horarios[dia].forEach(hora => {
        const option = document.createElement('option');
        option.value = hora;
        option.textContent = hora;
        timeSelect.appendChild(option);
      });
    } else {
      const option = document.createElement('option');
      option.textContent = 'Nenhum horário disponível';
      timeSelect.appendChild(option);
      timeSelect.disabled = true;
    }
  });

  scheduleBtn.addEventListener('click', () => {
    const data = dateInput.value;
    const horario = timeSelect.value;
    const nome = nameInput.value.trim();
    const email = emailInput.value.trim();

    if (!data || !horario || !nome || !email) {
      alert('Por favor, preencha todos os campos corretamente.');
      return;
    }

    fetch('agendar.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ data, horario, nome, email })
    })
    .then(res => res.json())
    .then(response => {
      console.log("Resposta do servidor:", response);

      if (!response || !response.message) {
        alert("Resposta inválida do servidor. Verifique o PHP.");
        return;
      }

      alert(response.message);

      if (response.status === 'success') {
        // Limpa os campos só se o agendamento deu certo
        dateInput.value = '';
        timeSelect.innerHTML = '<option value="">Selecione um dia para ver os horários</option>';
        timeSelect.disabled = true;
        nameInput.value = '';
        emailInput.value = '';
      }
    })
    .catch(err => {
      console.error("Erro na requisição:", err);
      alert('Erro ao enviar agendamento. Veja o console para mais detalhes.');
    });
  });
});
