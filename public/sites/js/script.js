$('[name=tab]').each(function(i,d){
    var p = $(this).prop('checked');
  //   console.log(p);
    if(p){
      $('article').eq(i)
        .addClass('on');
    }    
  });  
  
  $('[name=tab]').on('change', function(){
    var p = $(this).prop('checked');
    
    // $(type).index(this) == nth-of-type
    var i = $('[name=tab]').index(this);
    
    $('article').removeClass('on');
    $('article').eq(i).addClass('on');
  });

  //Id
  const actualBtn = document.getElementById('actual-btn');

  const fileChosen = document.getElementById('file-chosen');

  const actualBtns = document.getElementById('actual-btns');

  const fileChosens = document.getElementById('file-chosens');

  //passport
  const actualBtnP = document.getElementById('actual-btn-p');

  const fileChosenP = document.getElementById('file-chosen-p');

  //Driving
  const actualBtn3 = document.getElementById('actual-btn-3');

  const fileChosen3 = document.getElementById('file-chosen-3');

  const actualBtn4 = document.getElementById('actual-btn-4');

  const fileChosen4 = document.getElementById('file-chosen-4');
  
  actualBtn.addEventListener('change', function(){
    fileChosen.textContent = this.files[0].name;
  });


  actualBtns.addEventListener('change', function(){
    fileChosens.textContent = this.files[0].name;
  });

  actualBtn3.addEventListener('change', function(){
    fileChosen3.textContent = this.files[0].name;
  });

  actualBtn4.addEventListener('change', function(){
    fileChosen4.textContent = this.files[0].name;
  });

  actualBtnP.addEventListener('change', function(){
    fileChosenP.textContent = this.files[0].name;
  });