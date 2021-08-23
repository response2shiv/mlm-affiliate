$(document).ready(function() {
  // alert("Ready");
  hideLoading();
  
});

// Rank type dropdown event change
$('#selectRank').on('change', function () {
  let rank = $(this).val();
  let history = $('select#selectHistory').val();
  let type = $('input#hiddenRankType').val();
  
  getHistory(type, rank, history, false, true, true);
  
});

// Builds the value string to show at the contributors list
const setValue = function (contributor, limit = null) {
  if (typeof contributor.total !== 'undefined') {
    return `${formatNumber(parseFloat(contributor.total.replace(',','')), true)} / ${formatNumber(limit, true)}`;
  }

  return `${formatNumber(contributor.qv_contribution)} / ${formatNumber(contributor.min_qv)}`;
};

// Updates the contributors list
const updateContributors = function (type, contributors, limit = null) {
  $('#listContributors').html('');
  
  $.each(contributors, function (key, contributor) {
    let value = setValue(contributor,limit);
    
    $('#listContributors').append(`
      <a href="/report/pear/${contributor.user_id}" data-toggle="tooltip">
        <li class="list-group-item d-flex flex-row justify-content-between border-bottom font-contributors">
          ${contributor.firstname} ${contributor.lastname}
          <div>
              <span class="value">${value}</span>
              <span class="font-qv">${type}</span>
          </div>
        </li>
      </a>
    `);
  });
};

const formatNumber = function (value, decimals = false) {
  if (decimals) {
    return parseFloat(value).toLocaleString('en-US', {
      minimumFractionDigits: 2
    });
  }

  return parseInt(value).toLocaleString('en-US', {
    maximumFractionDigits: 0
  });
};

// Volume tab
$('ul#rankTypes li#volume').on('click', function () {
  $(this).addClass('tab-active');
  $('ul#rankTypes li#tsa').removeClass('tab-active');
  $('input#hiddenRankType').val('volume');
  showHistoryDropdown(true);
  let history = $('select#selectHistory').val(); 
  let rank = $('#hiddenRank').val();
  let type = $('input#hiddenRankType').val();
  
  getHistory(type, rank, history, true, true, true, 10);

});

// TSA tab
$('ul#rankTypes li#tsa').on('click', function () {
  $(this).addClass('tab-active');
  $('ul#rankTypes li#volume').removeClass('tab-active');
  $('input#hiddenRankType').val('tsa');
  showHistoryDropdown(false);

  let rank = $('select#selectRank').val();  
  getTsa(rank);
});

// Toggle history dropdown
const showHistoryDropdown = function (show) {
  let history = $('select#selectHistory');

  if (show) {
    history.removeClass('d-none');
  } else {
    history.addClass('d-none');
  }
};

// History dropdown event change
$('select#selectHistory').on('change', function () {  
  let history = $(this).val();
  let rank = $('select#selectRank').val();
  let type = $('input#hiddenRankType').val()  

  getHistory(type, rank, history, true, true, true, 10);  
  if ( $(this).val() != $("select#selectHistory option:eq(1)").val() ) {
    $("#selectRank").attr('disabled', 'true');
    $("#selectRank").addClass('d-none');
  }else{
    $("#selectRank").removeAttr('disabled', 'true');
    $("#selectRank").removeClass('d-none');
  }

});

// Requests the history endpoint
const getHistory = function (type,rank, history, left, center, right , centerRank = 0) {

  if (history === null) {
    history = moment().format('MMYYYY');
  }

  let month = history.substring(0, 2);
  let year = history.substring(2, 6);
  
  showLoading();
  
  ajaxReq(`/affiliate/dashboard/rank/${rank}/${month}/${year}`, 'GET', {}, function (res) {        
    console.log(res.data);
    if (left){
      updateLeft(type,res.data); 
    }
    if (center){
      updateCenter(type,res.data, centerRank);
    }
    if (right){
      
      if (type === 'volume'){
        
        top_type = 'QV';
        centerRank == 0 ? updateContributors(top_type, res.data.top_contributors) : updateContributors(top_type,res.data.top_contributors_current);

      }else{

        limit = parseFloat(res.data.qc_contributors.limit.replace(',',''));
        
        top_type = 'QC';
        updateContributors(top_type, res.data.qc_contributors.qcContributors,limit);
      
      } 
    
    }

    hideLoading();
  
  });
  
};

const updateLeft = function (type,data) {  
  
  if (type === 'volume') {      
    
    //label 
    $('#labelTotalMonthly').text('Total Monthly QV');
    $('#labelRankQualified').text('Rank Qualified Volume');   

    //value
    $('#valueTotalMonthly').html(data.rank_metrics.monthly_qv);
    $('#qv').html(data.rank_metrics.next_rank_current.rankqv);    
  
  } else {
    
    //label
    $('#labelTotalMonthly').text('Active TSA Credits');
    $('#labelRankQualified').text('Qualifying TSA Credits');

    //value
    $('#valueTotalMonthly').html(data.rank_metrics.monthly_qc);
    $('#qv').html(data.rank_metrics.qualifying_qc);

  }
   
  $('#valueMonthRankDesc').html(data.rank_metrics.monthly_rank_desc);

};

const updateCenter = function (type,data, centerRank) {  
  
  if (type === 'volume') {      
    
    //label     
    $('#labelMontlyNeeded').text('Monthly QV Needed');
    //value
   
    if (centerRank == 0){ 
      
      $('#nextQV').html(data.rank_metrics.rank_definition.min_qv);
      $('#qcDivPercentage').html('No more than '+( data.rank_metrics.rank_definition.rank_limit*100)+'% can come from a single personal leg.');
      $('#qv').html(data.rank_metrics.rank_definition.rankqv);

    }else{

      $('#nextQV').html(data.rank_metrics.next_rank_current.nextlevel_qv);
      $('#qcDivPercentage').html('No more than '+( data.rank_metrics.next_rank.nextlevel_percentage)+'% can come from a single personal leg.');

    }


  } else {
    
    //label
    $('#labelMontlyNeeded').text('Monthly QC Needed');
    
    //value
    if (centerRank == 0){ 
      
      $('#nextQV').html(data.rank_metrics.rank_definition.min_qc)
      $('#qcDivPercentage').html('No more than '+( data.rank_metrics.rank_definition.qc_percent*100)+'% can come from a single personal leg.');
      $('#qv').html(data.rank_metrics.rank_definition.qualifying_qc);

    }else{
      
      $('#nextQV').html(data.rank_metrics.next_rank_current.nextlevel_qc);
      $('#qcDivPercentage').html('No more than '+data.rank_metrics.next_rank_current.next_qc_percentage+'% can come from a single personal leg.');

    }
  }

  $('select#selectRank').find('option').remove();
    
  $.each(data.upper_ranks, function(key, data) {
    
    $('select#selectRank').append($('<option>', {
      value: data.rankval,
      text: data.rankdesc
    }));
  });
  
  if (centerRank == 0){
    $('#qualification').html(data.rank_metrics.rank_definition.rankdesc);    
    $('select#selectRank').val(data.rank_metrics.rank_definition.rankval+centerRank);
    $('#rightBinaryLimitValue').html(data.rank_metrics.rank_definition.min_binary_count);
    $('#leftBinaryLimitValue').html(data.rank_metrics.rank_definition.min_binary_count);    
  }else{
    $('#qualification').html(data.rank_metrics.next_rank_current.nextlevel_rankdesc);      
    $('select#selectRank').val(data.rank_metrics.rank+centerRank);
    $('#rightBinaryLimitValue').html(data.rank_metrics.next_rank_current.binary_limit);
    $('#leftBinaryLimitValue').html(data.rank_metrics.next_rank_current.binary_limit); 
  }  

};

//Remover daqui para baixo depois quando o history totalmente funcional

// Updates the values on the page
const updateValues = function (type,data) {
  if (type === 'volume') {
    $('#nextQV').html(data.current_monthly_qv);
    $('#qualification').val(data.nextlevel_rankdesc);
    $('#valueTotalMonthly').html(data.qv);
    $('#qv').html(data.rank_qv);    
    $('#qcDivPercentage').html('No more than '+( data.percentage ? data.percentage : data.next_rank.nextlevel_percentage ) +'% can come from a single personal leg.');
  } else {
    $('#nextQV').html(data.qc_volume);
    $('#qualification').val(data.nextlevel_rankdesc);
    $('#valueTotalMonthly').html(data.active_qc);
    $('#qv').html(data.qualifying_qc);
    $('#qcDivPercentage').html('No more than '+( data.qc_percent ? data.qc_percent : data.next_rank.next_qc_percentage )+'% can come from a single personal leg.');
  }

  $('#valueMonthRankDesc').html(data.achieved_rank_desc);
  
  
  hideLoading();
};
// Get volume data (rank without history)
const getVolume = function (rank) {
  showLoading();
  ajaxReq('/affiliate/ranks/insights', 'GET', {rank: rank}, function (res) {
    $('#qualification').text(res.data.qualification);
    $('#qv').text(res.data.qv);
    let contributors = res.data.v_contributors.contributors;
    updateLabels('volume');
    updateValues('volume', res.data);
    updateContributors(contributors);
    hideLoading();
  });
};

const getTsa = function (rank) {
  showLoading();
  ajaxReq(`/affiliate/ranks/insights/${rank}`, 'GET', {}, function (res) {
    console.log(res.data)
    updateLabels('tsa');
    updateValues('tsa', res.data);
    updateContributors('QC',res.data.qc_contributors.qcContributors, res.data.qc_contributors.limit);
    hideLoading();
  });
};

// Updates a few labels 
const updateLabels = function (type) {  
  
  if (type === 'volume') {
    $('#labelMontlyNeeded').text('Monthly QV Needed');
    $('#labelTotalMonthly').text('Total Monthly QV');
    $('#labelRankQualified').text('Rank Qualified Volume');
  } else {
    $('#labelMontlyNeeded').text('Monthly QC Needed');
    $('#labelTotalMonthly').text('Active TSA Credits');
    $('#labelRankQualified').text('Qualifying TSA Credits');
  }
};