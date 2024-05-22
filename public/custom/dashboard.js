// Fetch data from the server
async function fetchSalesData() {
    const response = await fetch('/sections-data');
    return response.json();
}

// Render chart when the page loads
window.addEventListener("load", async function(){
    // Render chart
    const sectionStatusData = await fetchSalesData();
        
    const section_names = sectionStatusData.map(item => item.section_name);
    const newLetters = sectionStatusData.map(item => item.status_1_count);
    const processingLetters = sectionStatusData.map(item => item.status_2_count);

    try {
  
        getcorkThemeObject = localStorage.getItem("theme");
        getParseObject = JSON.parse(getcorkThemeObject)
        ParsedObject = getParseObject;

        

        if (ParsedObject.settings.layout.darkMode) {
            var Theme = 'dark';

            Apex.tooltip = {
                theme: Theme
            }

            /**
                ==============================
                |    @Options Charts Script   |
                ==============================
            */


            /*
                ======================================
                    শাখা ভিত্তিক পত্রের অবস্থা Bar Chart | Options
                ======================================
            */
            var options1 = {
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {
                        show: false,
                    }
                },
                colors: ['#4361ee', '#ffbb44'],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded',
                        borderRadius: 10,
                    },
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    position: 'bottom',
                    horizontalAlign: 'center',
                    fontSize: '14px',
                    markers: {
                        width: 10,
                        height: 10,
                        offsetX: -5,
                        offsetY: 0
                    },
                    itemMargin: {
                        horizontal: 10,
                        vertical: 8
                    }
                },
                grid: {
                    borderColor: '#e0e6ed',
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                series: [{
                    name: 'নতুন',
                    data: newLetters
                }, {
                    name: 'প্রক্রিয়াধীন',
                    data: processingLetters
                }],
                xaxis: {
                    categories: section_names,
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        type: 'vertical',
                        shadeIntensity: 0.3,
                        inverseColors: false,
                        opacityFrom: 1,
                        opacityTo: 0.8,
                        stops: [0, 100]
                    }
                },
                tooltip: {
                    marker: {
                        show: false,
                    },
                    theme: 'dark',
                    y: {
                        formatter: function (val) {
                            return val;
                        }
                    }
                },
                responsive: [
                    { 
                        breakpoint: 767,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 0,
                                    columnWidth: "50%"
                                }
                            }
                        }
                    },
                ]
            }

        } else {
            var Theme = 'dark';
      
            Apex.tooltip = {
                theme: Theme
            }
            
            /**
                ==============================
                |    @Options Charts Script   |
                ==============================
            */

            /*
                ======================================
                    শাখা ভিত্তিক পত্রের অবস্থা Bar Chart | Options
                ======================================
            */
            var options1 = {
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {
                        show: false,
                    }
                },
                colors: ['#4361ee', '#ffbb44'],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded',
                        borderRadius: 10,
                
                    },
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    position: 'bottom',
                    horizontalAlign: 'center',
                    fontSize: '14px',
                    markers: {
                        width: 10,
                        height: 10,
                        offsetX: -5,
                        offsetY: 0
                    },
                    itemMargin: {
                        horizontal: 10,
                        vertical: 8
                    }
                },
                grid: {
                    borderColor: '#e0e6ed',
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                series: [{
                    name: 'নতুন',
                    data: newLetters
                }, {
                    name: 'প্রক্রিয়াধীন',
                    data: processingLetters
                }],
                xaxis: {
                    categories: section_names,
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                    shade: Theme,
                    type: 'vertical',
                    shadeIntensity: 0.3,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 0.8,
                    stops: [0, 100]
                    }
                },
                tooltip: {
                    marker : {
                        show: false,
                    },
                    theme: Theme,
                    y: {
                        formatter: function (val) {
                            return val
                        }
                    }
                },
                responsive: [
                    { 
                        breakpoint: 767,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 0,
                                    columnWidth: "50%"
                                }
                            }
                        }
                    },
                ]
            }

        }

        /**
          ==============================
          |    @Render Charts Script    |
          ==============================
        */
       
        /**
            ======================================
            শাখা ভিত্তিক পত্রের অবস্থা Bar Chart | Script
            ======================================
        */
        var barChart = new ApexCharts(document.querySelector("#statusBarChart"), options1);
        barChart.render();



        /**
         * =================================================================================================
         * |     @Re_Render | Re render all the necessary JS when clicked to switch/toggle theme           |
         * =================================================================================================
         */

        document.querySelector('.theme-toggle').addEventListener('click', function() {

            getcorkThemeObject = localStorage.getItem("theme");
            getParseObject = JSON.parse(getcorkThemeObject)
            ParsedObject = getParseObject;
      
            // console.log(ParsedObject.settings.layout.darkMode)
      
            if (ParsedObject.settings.layout.darkMode) {
      
                 /*
                    ==============================
                    |    @Re-Render Charts Script    |
                    ==============================
                */
            
                /*
                    ===================================
                        শাখা ভিত্তিক পত্রের অবস্থা | Script
                    ===================================
                */
            
                barChart.updateOptions({
                grid: {
                        borderColor: '#191e3a',
                    },
                })
                
            } else {
                
                /*
                    ==============================
                    |    @Re-Render Charts Script    |
                    ==============================
                */
            
                /*
                    ===================================
                        শাখা ভিত্তিক পত্রের অবস্থা | Script
                    ===================================
                */
            
                barChart.updateOptions({
                grid: {
                        borderColor: '#e0e6ed',
                    },
                })
              
            }
           
        })
    } catch(e) {
        // statements
        console.log(e);
    }
})

