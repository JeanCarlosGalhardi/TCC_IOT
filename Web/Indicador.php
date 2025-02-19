<body>
    <div class="dashboard">
        <svg class="progress-ring" width="150" height="150">
            <circle class="background" cx="75" cy="75" r="60" />
            <circle class="progress" cx="75" cy="75" r="60" stroke-dasharray="377" stroke-dashoffset="377" />
        </svg>
        <div class="percentage">0%</div>
    </div>

    <script>
        function updateIndicator(value) {
            const circle = document.querySelector('.progress');
            const percentageText = document.querySelector('.percentage');
            const maxOffset = 377;
            const offset = maxOffset - (value / 100) * maxOffset;
            
            circle.style.strokeDashoffset = offset;
            percentageText.textContent = `${value}%`;
            if (value < 25 ) {
                circle.style.stroke = 'green';
            } else if (value < 50 ) {
                circle.style.stroke = 'yellow';
            } else if (value < 75 ){ 
                circle.style.stroke = 'orange';
            } else {
                circle.style.stroke = 'red';
            }
        }        
        updateIndicator(Math.round(100-(<?php  echo ''; include 'ultimaleitura.php'; ?>/12)*100));
    </script>