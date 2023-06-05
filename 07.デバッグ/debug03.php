<?php

session_start();

if (! isset($_SESSION['result'])) {
  $_SESSION['result'] = 0;
}

class Player
{
  public function jankenConverter(int $choice): string
  {
      $janken = '';
      switch ($choice) {
          case 1:
              $janken = 'グー';
              break;
          case 2:
              $janken = 'チョキ';
              break;
          case 3:
              $janken = 'パー';
              break;
          default:
              break;
      }
      return $janken;
  }
}

class Me extends Player
{
  private $name;
  private $choice;

  public function __construct(string $lastName, string $firstName, int $choice)
  {
      $this->name   = $lastName.$firstName;
      $this->choice = $choice;
  }

  public function getName(): string
  {
      return $this->name;
  }

  public function getChoice(): string
  {
      return $this->jankenConverter($this->choice);
  }
}

class Enemy extends Player
{
  private $choice;
  public function __construct()
  {
      $this->choice = random_int(1, 3);
  }

  public function getChoice(): string
  {
      return $this->jankenConverter($this->choice);
  }
}

class Battle
{
  private $first;
  private $second;
  public function __construct(Me $me, Enemy $enemy)
  {
      $this->first  = $me->getChoice();
      $this->second = $enemy->getChoice();
  }

  // private function judge(): int
  public function judge(): string
  {
      if ($this->first === $this->second) {
          return '引き分け';
      }

      if ($this->first === 'グー' && $this->second === 'チョキ') {
          return '勝ち';
      }

      if ($this->first === 'グー' && $this->second === 'パー') {
          return '負け';
      }

      if ($this->first === 'チョキ' && $this->second === 'グー') {
          return '負け';
      }

      if ($this->first === 'チョキ' && $this->second === 'パー') {
          return '勝ち';
      }

      if ($this->first === 'パー' && $this->second === 'グー') {
          return '勝ち';
      }

      if ($this->first === 'パー' && $this->second === 'チョキ') {
          return '負け';
      }
  }

  public function countVictories()
  {
      if ($this->judge() === '勝ち') {
          // $_SESSION['result'] = 1;
          $_SESSION['result'] += 1;
      }
      return $_SESSION['result'];
  }

  // public function getVictories()
  // {
  //     return $_SESSION['result'];
  // }

  // private function showResult()
  public function showResult(): string
  {
      return $this->judge();
  }
}

if (! empty($_POST)) {
  $me    = new Me($_POST['last_name'], $_POST['first_name'], $_POST['choice'], $_POST['choice']);
  $enemy = new Enemy();
  echo $me->getName().'は'.$me->getChoice().'を出しました。';
  echo '<br>';
  echo '相手は'.$enemy->getChoice().'を出しました。';
  echo '<br>';
  $battle = new Battle($me, $enemy);
  echo '勝敗は'.$battle->showResult().'です。';
  if ($battle->showResult() === '勝ち') {
      echo '<br>';
      // echo $battle->getVictories().'回目の勝利です。';
      echo $battle->countVictories().'回目の勝利です。';
  }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ジャンケン結果</title>
</head>
<body>
    <section>
    </section>
</body>
</html>
