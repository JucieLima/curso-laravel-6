<?php

function getItemsByStoreId(array $items, $storeId)
{
    return array_filter($items, function ($line) use ($storeId) {
        return $line['store_id'] == $storeId;
    });
}

function formatMoneyToDatabase($money)
{
    return str_replace(['.', ',', 'R$ '], ['', '.', ''], $money);
}
