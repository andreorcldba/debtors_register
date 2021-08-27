$.ajax({
  url: `/dashboard/1`,
  type: 'GET',
  contentType: 'application/x-www-form-urlencoded',
  success: (data) => {
    data = JSON.parse(data)
    groups = [];
    values = [];
    
    for (i = 0; i < data.length; i++) {
      groups.push(data[i].g);
      values.push(data[i].v);
    }
    
    new Chart(document.getElementById("line-chart"), {
    type: 'line',
    data: {
    labels: groups,
    datasets: [{ 
        data: values,
        label: "Entrada de devedores e empresas",
        borderColor: "#3e95cd",
        fill: false
      }
    ]
  },
});
  },
  error: (xhr, error_text, statusText) => {
      console.log({
          xhr: xhr,
          error_text: error_text,
          statusText: statusText
      })
  }
})