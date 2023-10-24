<div class="container">
  <div class="border-top"></div>
</div>

<nav>
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>
      </li>
      <li class="breadcrumb-item">
        <a class="link-unstyled" href="{$Rewrite->url_trialtest($test)}">{$test.name}</a>
      </li>
      <li class="breadcrumb-item active">Xếp hạng</li>
    </ol>
  </div>
</nav>

<section class="section mb-50">
  <div class="container">
    <h1 class="text-24 text-700 text-uppercase text-center">{$test.name}</h1>
    <h2 class="text-16 text-700 text-uppercase text-center mb-30">Bảng xếp hạng điểm cao</h2>
    {if !$test}
      <div class="alert alert-danger">Bài thi không tồn tại!</div>
    {elseif !$highScores}
      <div class="alert alert-warning">Chưa có thí sinh tham gia!</div>
    {else}
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th class="bg-primary text-white text-center">STT</th>
              <th class="bg-primary text-white">Họ và tên</th>
              <th class="bg-primary text-white text-center">Ngày thi</th>
              {if $test.level_id == 9 OR $test.level_id == 4}
              <th class="bg-primary text-white text-right">Từ vựng + Ngữ pháp + Đọc hiểu</th>
              {else}
              <th class="bg-primary text-white text-right">Từ vựng + Ngữ pháp</th>
              <th class="bg-primary text-white text-right">Đọc hiểu</th>
              {/if}
              <th class="bg-primary text-white text-right">Nghe hiểu</th>
              <th class="bg-primary text-white text-right">Tổng điểm</th>
            </tr>
          </thead>
          <tbody>
            {foreach from=$highScores key=i item=score}
              <tr>
                <td class="text-center">{$i + 1}</td>
                <td>
                  <div class="media align-items-center">
                    <img src="{$core->callfunc("validAvatar", $score.avatar)}" class="mr-3" alt="" width="35" height="35" style="border-radius: 50%">
                    <div class="media-body">{$score.fullname}</div>
                  </div>
                </td>
                <td class="text-center">{$score.reg_date|date_format:"%d/%m/%Y"}</td>
                {if $test.level_id eq 9 or $test.level_id eq 4}
                <td class="text-right text-16">{($score.vocabulary_score + $score.reading_score)}/120</td>
                {else}
                <td class="text-right text-16">{$score.vocabulary_score}/60</td>
                <td class="text-right text-16">{$score.reading_score}/60</td>
                {/if}
                <td class="text-right text-16">{$score.listening_score}/60</td>
                <td class="text-right text-16 text-700 text-danger">{$score.total_score}/180</td>
              </tr>
            {/foreach}
          </tbody>
        </table>
      </div>
    {/if}
  </div>
</section>
