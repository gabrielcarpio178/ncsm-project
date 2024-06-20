$(document).ready(()=>{
  regions();
  pregions();
  birthplace_regions();
  $(".txt, #region, .checkbox").each(function() {
    $(this).change(function(){
        var region = $('option:selected', this).attr('data-id');
        province(region);
    });
  });

  $(".txt, #province, .checkbox").each(function() {
    $(this).change(function(){
        var muni = $('option:selected', this).attr('data-id');
        city(muni);
    });
  });

  $(".txt, #muni, .checkbox").each(function() {
    $(this).change(function(){
        var city = $('option:selected', this).attr('data-id');
        district(city);
    });
  });

  $(".txt, #pregion, .checkbox").each(function() {
    $(this).change(function(){
        var region = $('option:selected', this).attr('data-id');
        pprovince(region);
    });
  });

  $(".txt, #pprovince, .checkbox").each(function() {
    $(this).change(function(){
        var muni = $('option:selected', this).attr('data-id');
        pcity(muni);
    });
  });

  $(".txt, #pmuni, .checkbox").each(function() {
    $(this).change(function(){
        var city = $('option:selected', this).attr('data-id');
        pdistrict(city);
    });
  });

  $(".txt, #birthplace-region, .checkbox").each(function() {
    $(this).change(function(){
        var region = $('option:selected', this).attr('data-id');
        birthplace_province_select(region);
    });
  });

  $(".txt, #birthplace-province, .checkbox").each(function() {
    $(this).change(function(){
        var muni = $('option:selected', this).attr('data-id');
        birthplace_city(muni);
    });
  });

  iscroll();

})

var regions_ = document.getElementById('region');
var province_ = document.getElementById('province');
var city_= document.getElementById('muni');
var district_ = document.getElementById('dist')

var pregions_ = document.getElementById('pregion');
var pprovince_ = document.getElementById('pprovince');
var pcity_= document.getElementById('pmuni');
var pdistrict_ = document.getElementById('pdist')

var birthplace_province = document.getElementById('birthplace-province');
var birthplace_region = document.getElementById('birthplace-region');
var birthplace_pmuni = document.getElementById('birthplace-pmuni');


var requestOptions = {
  method: 'GET',
  redirect: 'follow'
};
function regions(){
  fetch("https:/psgc.gitlab.io/api/regions/", requestOptions)
    .then(response => response.json())
    .then(result =>
      (
        result.forEach(element => {
          const option = document.createElement('option');
          option.value = element.name;
          option.dataset.id = element.code
          option.textContent = element.regionName
          regions_.appendChild(option);
        })
      )
    )
    .catch(error => console.log('error', error));
}

function birthplace_regions(){
    fetch("https:/psgc.gitlab.io/api/regions/", requestOptions)
      .then(response => response.json())
      .then(result =>
        (
          result.forEach(element => {
            const option = document.createElement('option');
            option.value = element.name;
            option.dataset.id = element.code
            option.textContent = element.regionName
            birthplace_region.appendChild(option);
          })
        )
      )
      .catch(error => console.log('error', error));
  }
  function pregions(){
    fetch("https:/psgc.gitlab.io/api/regions/", requestOptions)
      .then(response => response.json())
      .then(result =>
        (
          result.forEach(element => {
            const option = document.createElement('option');
            option.value = element.name;
            option.dataset.id = element.code
            option.textContent = element.regionName
            pregion.appendChild(option);
          })
        )
      )
      .catch(error => console.log('error', error));
  }

function province(regionCode){
    let option_province = "<option value='' selected>Select Province</option>";
    province_.innerHTML = option_province;
    fetch(`https:/psgc.gitlab.io/api/regions/${regionCode}/provinces`, requestOptions)
        .then(response => response.json())
        .then(result =>
        (
            result.forEach(element => {
            const option = document.createElement('option');
            option.value = element.name;
            option.dataset.id = element.code
            option.textContent = element.name
            province_.appendChild(option);

            })
        )
        )
        .catch(error => console.log('error', error));
}

function pprovince(regionCode){
    let option_province = "<option value='' selected>Select Province</option>";
    pprovince_.innerHTML = option_province;
    fetch(`https:/psgc.gitlab.io/api/regions/${regionCode}/provinces`, requestOptions)
        .then(response => response.json())
        .then(result =>
        (
            result.forEach(element => {
            const option = document.createElement('option');
            option.value = element.name;
            option.dataset.id = element.code
            option.textContent = element.name
            pprovince_.appendChild(option);

            })
        )
        )
        .catch(error => console.log('error', error));
}

function birthplace_province_select(regionCode){
  let option_province = "<option value='' selected>Select Province</option>";
  birthplace_province.innerHTML = option_province;
  fetch(`https:/psgc.gitlab.io/api/regions/${regionCode}/provinces`, requestOptions)
    .then(response => response.json())
    .then(result =>
      (
        result.forEach(element => {
          const option = document.createElement('option');
          option.value = element.name;
          option.dataset.id = element.code
          option.textContent = element.name
          birthplace_province.appendChild(option);
        })
      )
    )
    .catch(error => console.log('error', error));
}

function city(province){
  let option_city = "<option value='' selected>Select City</option>";
  city_.innerHTML = option_city;
  fetch(`https:/psgc.gitlab.io/api/provinces/${province}/cities-municipalities/`, requestOptions)
    .then(response => response.json())
    .then(result => (
        result.forEach(element => {
          const option = document.createElement('option');
          option.value = element.name;
          option.dataset.id = element.code
          option.textContent = element.name
          city_.appendChild(option);
        })
      )
    )
    .catch(error => console.log('error', error));
}

function pcity(province){
    let option_city = "<option value='' selected>Select City</option>";
    pcity_.innerHTML = option_city;
    fetch(`https:/psgc.gitlab.io/api/provinces/${province}/cities-municipalities/`, requestOptions)
      .then(response => response.json())
      .then(result => (
          result.forEach(element => {
            const option = document.createElement('option');
            option.value = element.name;
            option.dataset.id = element.code
            option.textContent = element.name
            pcity_.appendChild(option);
          })
        )
      )
      .catch(error => console.log('error', error));
  }

function birthplace_city(province){
    let option_city = "<option value='' selected>Select City</option>";
    birthplace_pmuni.innerHTML = option_city;
    fetch(`https:/psgc.gitlab.io/api/provinces/${province}/cities-municipalities/`, requestOptions)
      .then(response => response.json())
      .then(result => (
          result.forEach(element => {
            const option = document.createElement('option');
            option.value = element.name;
            option.textContent = element.name
            option.dataset.id = element.code
            birthplace_pmuni.appendChild(option);
          })
        )
      )
      .catch(error => console.log('error', error));
  }


function district(city){
  let option_city = "<option value='' selected>Select Districts</option>";
  district_.innerHTML = option_city;
  fetch(`https:/psgc.gitlab.io/api/districts`, requestOptions)
    .then(response => response.json())
    .then(result => (
        result.forEach(element => {
          const option = document.createElement('option');
          option.value = element.name;
          option.textContent = element.name
          option.dataset.id = element.code
          district_.appendChild(option);
        })
      )
    )
    .catch(error => console.log('error', error));
}

function pdistrict(city){
    let option_city = "<option value='' selected>Select Districts</option>";
    pdistrict_.innerHTML = option_city;
    fetch(`https:/psgc.gitlab.io/api/districts`, requestOptions)
      .then(response => response.json())
      .then(result => (
          result.forEach(element => {
            const option = document.createElement('option');
            option.value = element.name;
            option.textContent = element.name
            option.dataset.id = element.code
            pdistrict_.appendChild(option);
          })
        )
      )
      .catch(error => console.log('error', error));
  }


function iscroll(){
    const privacyPolicy = document.getElementById("privacyPolicy");
    privacyPolicy.addEventListener('click',()=>{
        document.getElementById('id01').style.display='block';
    })
}

function removeDisabled(){
    const selected = document.querySelectorAll('select');
    selected.forEach(select=>{
        select.removeAttribute("disabled");
    })
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input=>{
        input.removeAttribute("disabled");
    })
    const radios = document.querySelectorAll('.radio-input');
    radios.forEach(radio=>{
        radio.removeAttribute("disabled");
    })
    const checkboxs = document.querySelectorAll("input[type='checkbox']");
    checkboxs.forEach(checkbox=>{
        checkbox.removeAttribute("disabled");
    })
}


function isShowNav(){
    var element = document.getElementById("navigition");
    element.classList.toggle("navi");
}
