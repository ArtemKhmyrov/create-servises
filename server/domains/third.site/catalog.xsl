<?xml version="1.0"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output
        method="html"
        indent="yes" 
    />
<xsl:template match="/">
    <html>
        <head>
            <title>Наши книги</title> 
            <style type="text/css">
                * {margin: 0px; padding: 0px}
                h1 {padding: 1rem; text-align: center: background: #ccf}
                table {margin: 1rem; border-collapse: collapse}
                td {border: 5px solid gray; padding: .5rem}
                thead td {text-align: center; background: #ccf; font-weight: bold}
                #colTitle {width: 18.75rem}
                #colAuthor {width: 18.75rem}
                #colPubyear {width: 6.25rem}
                #colPrice {width: 6.25rem}
                .expencebook{background: yellow;}
            </style>
        </head>

        <body>
            <h1>Наши книги</h1>
            <table>
                <thead>
                    <td id='colTitle'>Наименование</td>
                    <td id='colAuthor'>Автор</td>
                    <td id='colPubYear'>Год издание</td>
                    <td id='colPrice'>Цена</td>
                </thead>
                <tbody>
                    <xsl:apply-templates select="/catalog/book" />
                </tbody>
            </table>
        </body>
    </html>

    </xsl:template>

    <!-- Для кник стоимостью больше 200 рублей -->

    <xsl:template match="book[price &lt; 200]">
        <tr>
            <xsl:apply-templates select="./*" />
        </tr>
    </xsl:template>

    <!-- Для кник стоимостью меньше 200 рублей -->

    <xsl:template match="book[price &gt; 200]">
        <tr class="expenceBook">
            <xsl:apply-templates select="./*" />
        </tr>
    </xsl:template>

    <!-- Для отрисовки ждочерних элементов -->

    <xsl:template match="book/*">
        <td>
            <xsl:value-of select="." />
        </td>
    </xsl:template>

</xsl:stylesheet>