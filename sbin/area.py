#!/usr/bin/env python
# encoding=utf8
from lxml import etree
import urllib.request as client
from bs4 import BeautifulSoup
import json


# 根据url获取页面源码
def query_page_source(url):
    page = client.urlopen(url)
    return page.read()


# 根据源码获取相关的td节点dom
def query_td_tags(html):
    soup = BeautifulSoup(html, 'html.parser')
    return soup.findAll('tr', {'height': '19'})


# 根据tr列表数据构建集合
def generate_json_collect(tr_list):
    collect = {}
    for tr in tr_list:
        td_list = tr.findAll('td')
        collect[td_list[1].string.strip()] = td_list[2].text.strip()
    return collect


# 构建PHP类文件
def generate_php_collect(collect):
    with open('../src/IdentityCard/Data/Area.php', mode='w') as file:
        file.seek(0)
        file.truncate()
        file.write('<?php\n\n')
        file.write('namespace AlicFeng\IdentityCard\Data;\n')
        file.write('class Area\n{\n')
        file.write('\tconst DATA = [\n')
        for key, value in collect.items():
            file.write('\t\t' + '\'' + key.strip() + '\'=>' + '\'' + value.strip() + '\',\n')
        file.write('];\n}\n')
        file.flush()
        file.close()


# 将内容写进文件
def write_file(content):
    file = open('../src/IdentityCard/Data/area.json', mode='w')
    file.write(content)
    file.flush()
    file.close()


# 根据集合构建json数据
def generate_json(collect):
    return json.dumps(collect, ensure_ascii=False)


if __name__ == '__main__':
    url = 'http://www.mca.gov.cn/article/sj/xzqh/2019/2019/202002191838.html'
    source = query_page_source(url)
    tr_list = query_td_tags(source)
    collect = generate_json_collect(tr_list)
    json = generate_json(collect)
    write_file(json)
    generate_php_collect(collect)
