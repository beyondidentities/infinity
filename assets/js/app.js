import Alpine from 'alpinejs';
import cmptEvolutionEnrollmentRegistrationForm from 'components/evolution-enrollment-registration.js'

// set Component to Alpine data
window.Alpine = Alpine

Alpine.data('cmptEvolutionEnrollmentRegistrationForm', cmptEvolutionEnrollmentRegistrationForm);

Alpine.start();
