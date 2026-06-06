<?php

namespace App\Services;

class TopsisService
{
    private array $alternatives;
    private array $weights;
    private array $criteria;

    public function __construct(array $alternatives, array $weights, array $criteria)
    {
        $this->alternatives = $alternatives;
        $this->weights = $weights;
        $this->criteria = $criteria;
    }

    public function rank(): array
    {
        $normalized = $this->normalizeMatrix();
        $weighted = $this->applyWeights($normalized);
        $ideals = $this->calculateIdealSolutions($weighted);

        $scores = [];
        foreach ($weighted as $index => $row) {
            $dPlus = $this->euclideanDistance($row, $ideals['positive']);
            $dMinus = $this->euclideanDistance($row, $ideals['negative']);
            
            $closeness = ($dPlus + $dMinus) === 0.0 ? 0 : $dMinus / ($dPlus + $dMinus);

            $scores[] = [
                'alternative' => $this->alternatives[$index]['name'],
                'score' => round($closeness, 4) // Redondeamos para mejor visualización
            ];
        }

        // Ordenar de mayor a menor score
        usort($scores, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $scores;
    }

    private function normalizeMatrix(): array
    {
        $columns = count($this->alternatives[0]['values']);
        $denominators = array_fill(0, $columns, 0);

        // Calcular denominadores (raíz de la suma de los cuadrados)
        for ($col = 0; $col < $columns; $col++) {
            $sum = 0;
            foreach ($this->alternatives as $alt) {
                $sum += pow($alt['values'][$col], 2);
            }
            $denominators[$col] = sqrt($sum);
        }

        // Normalizar matriz
        $normalized = [];
        foreach ($this->alternatives as $i => $alt) {
            foreach ($alt['values'] as $col => $value) {
                $normalized[$i][$col] = $denominators[$col] == 0 ? 0 : $value / $denominators[$col];
            }
        }

        return $normalized;
    }

    private function applyWeights(array $matrix): array
    {
        $weighted = [];
        foreach ($matrix as $i => $row) {
            foreach ($row as $col => $value) {
                $weighted[$i][$col] = $value * $this->weights[$col];
            }
        }
        return $weighted;
    }

    private function calculateIdealSolutions(array $matrix): array
    {
        $cols = count($matrix[0]);
        $positiveIdeal = [];
        $negativeIdeal = [];

        for ($col = 0; $col < $cols; $col++) {
            $columnValues = array_column($matrix, $col);

            if ($this->criteria[$col] === 'benefit') {
                $positiveIdeal[] = max($columnValues);
                $negativeIdeal[] = min($columnValues);
            } else {
                $positiveIdeal[] = min($columnValues);
                $negativeIdeal[] = max($columnValues);
            }
        }

        return ['positive' => $positiveIdeal, 'negative' => $negativeIdeal];
    }

    private function euclideanDistance(array $a, array $b): float
    {
        $sum = 0;
        foreach ($a as $i => $value) {
            $sum += pow($value - $b[$i], 2);
        }
        return sqrt($sum);
    }
}