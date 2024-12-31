const ageOfMajority = 18;
const maximumAge = 100;

const today = new Date();
eighteenYearsAgo = today.setFullYear(today.getFullYear() - ageOfMajority);
maxAllowedDate = today.setFullYear(today.getFullYear() - maximumAge);

config ={
    locale: {
        firstDayOfWeek: 1,
        weekdays: {
          shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
          longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
        }, 
        months: {
          shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
          longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        },
    },   
    minDate: maxAllowedDate,
    disable: [
        function(date) {
          // Deshabilita las fechas menores de 18 años
          return date > eighteenYearsAgo;
        }
      ],
    dateFormat: "d-m-Y",

  };
  flatpickr("#fechaNacimiento", config);