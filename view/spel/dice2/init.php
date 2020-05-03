<?php

namespace Anax\View;

/**
 * View for setting up dice game
 */

?><h1>Tärning 100</h1>

<div class="init">

    <h2>Starta spelet</h2>

    <form method="post" class="init-form">
        <label for "name">Namn:</label>
        <input type="text" name="name" required autofocus>
        <label for "dices">Antal tärningar:</label>
        <input type="number" name="dices" min=1 max=5 value=3 required>
        <label for "players">Antar motståndare:</label>
        <input type="number" name="players" min=1 max=5 value=2 required>
        <input type="submit" name="start" class="start" value="Starta spelet">
    </form>

</div>

<div class="rules">

    <h2>Spelregler</h2>

    <p>Under varje runda kastar en spelare alla sina tärningar. Om tärningarna har värden mellan 2-6 räknas poängen ihop. Spelaren får därefter välja att antingen spara tärningssumman och lämna över turen till nästa spelare eller chansa och slå en gång till i hopp om att öka summan. Om man slår en etta förlorar man de poäng man fått ihop under rundan och turen går vidare till nästa spelare. Första spelaren att nå minst 100 poäng vinner.</p>

    <p>Lycka till!</p>

</div>
